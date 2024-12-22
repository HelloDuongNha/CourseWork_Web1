<?php
require "DatabaseConnection.php";
// require "../Log in/check.php";

function setTitle($name)
{
    ob_start();
    include '../includes/DatabaseConnection.php';
    return $name;
};

function setClean()
{
    $output = ob_get_clean();
    include '../templates/user_layout.html.php';
    return $output;
}

function GetAllModule($pdo)
{
    $sql = "SELECT * FROM modules";
    $modules = $pdo->query($sql);
    return $modules->fetchAll();
}

function CountPostsByModuleId($pdo, $module_id)
{
    $sql = "SELECT COUNT(*) FROM posts WHERE module_id = :module_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':module_id', $module_id);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function CountPostsByRepostModuleId($pdo, $repost_module_id)
{
    $sql = "SELECT COUNT(*) FROM posts WHERE repost_module_id = :repost_module_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':repost_module_id', $repost_module_id);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function GetAllPosts($pdo)
{
    $sql = "
    SELECT 
        posts.*,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar,
        main_module.module_name AS module_name, 
        repost_module.module_name AS repost_module_name
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
    INNER JOIN 
        modules AS main_module 
        ON posts.module_id = main_module.module_id 
    LEFT JOIN 
        modules AS repost_module 
        ON posts.repost_module_id = repost_module.module_id
    LEFT JOIN 
        users AS users_repost 
        ON posts.repost_user_id = users_repost.user_id
    ORDER BY 
        posts.post_id DESC
    ";

    // Execute SQL and fetch results
    $posts = $pdo->query($sql);
    return $posts->fetchAll();
}

function ProfileGetAllPost($pdo, $user_id)
{
    $sql = "
    SELECT 
        posts.*,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar,
        modules.module_name
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
    INNER JOIN 
        modules 
        ON posts.module_id = modules.module_id
    LEFT JOIN 
        users AS users_repost 
        ON posts.repost_user_id = users_repost.user_id
    WHERE posts.user_id = :user_id and posts.repost_check = 0
    ORDER BY 
        posts.post_id DESC
    ";

    // Execute SQL and fetch results
    $posts = $pdo->prepare($sql);
    $posts->bindValue(':user_id', $user_id);
    $posts->execute();
    return $posts->fetchAll();
}

function ProfileGetAllRepost($pdo, $repost_user_id)
{
    $sql = "
    SELECT 
        posts.*,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar,
        main_module.module_name AS module_name, 
        repost_module.module_name AS repost_module_name 
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
    INNER JOIN 
        modules AS main_module 
        ON posts.module_id = main_module.module_id -- Đổi tên join modules thành main_module
    LEFT JOIN 
        modules AS repost_module 
        ON posts.repost_module_id = repost_module.module_id
    LEFT JOIN 
        users AS users_repost 
        ON posts.repost_user_id = users_repost.user_id
    WHERE 
        posts.repost_user_id = :repost_user_id
    ORDER BY 
        posts.post_id DESC
    ";

    // Execute SQL and fetch results
    $posts = $pdo->prepare($sql);
    $posts->bindValue(':repost_user_id', $repost_user_id);
    $posts->execute();
    return $posts->fetchAll();
}

function GetAllUser($pdo)
{
    $sql = "SELECT * FROM users;";
    $users = $pdo->query($sql);
    return $users->fetchall();
}

function GetAllDataUser($pdo, $user_id)
{
    $sql = "SELECT * FROM users
    WHERE user_id = :user_id";
    $user = $pdo->prepare($sql);
    $user->bindValue(':user_id', $user_id);
    $user->execute();
    return $user->fetch(PDO::FETCH_ASSOC);
}

function getUserIdByTag($pdo, $user_tag)
{
    // Chuẩn bị câu lệnh SQL
    $query = "SELECT user_id FROM users WHERE user_tag = :user_tag";

    // Chuẩn bị và thực thi truy vấn
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_tag', $user_tag);
    $statement->execute();

    $user_id = $statement->fetchColumn();
    return $user_id;
}

function CheckUploadImage($file, $repo)
{
    // Kiểm tra và xử lý ảnh
    $image_name = NULL; // Mặc định là NULL nếu không có ảnh
    if (isset($file) && $file['error'] === 0) {
        $upload_dir = $repo;  // Thư mục lưu ảnh
        $filename = basename($file['name']);  // Lấy tên file
        $target_path = $upload_dir . $filename;  // Đường dẫn đầy đủ tới file ảnh

        // Kiểm tra và validate ảnh
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($file['tmp_name']);
        if ($check !== false) {
            // Nếu là ảnh
            $uploadOk = 1;
        } else {
            $_SESSION['error_message'] = "File is not an image.";
            $uploadOk = 0;
        }

        // Kiểm tra file size (Max: 5MB)
        if ($file["size"] > 5000000) {
            $_SESSION['error_message'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $_SESSION['error_message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Kiểm tra nếu tất cả các điều kiện hợp lệ
        if ($uploadOk == 1) {
            // Kiểm tra tên file có tồn tại không
            $counter = 1;
            $file_base = pathinfo($filename, PATHINFO_FILENAME); // Lấy tên file không có đuôi
            $extension = pathinfo($filename, PATHINFO_EXTENSION); // Lấy phần mở rộng file (jpg, png, ...)

            // Kiểm tra và thay đổi tên file nếu trùng
            while (file_exists($target_path)) {
                $filename = $file_base . "($counter)." . $extension; // Tạo tên mới với (counter)
                $target_path = $upload_dir . $filename; // Đường dẫn mới
                $counter++; // Tăng counter lên
            }

            // Lưu file vào thư mục upload
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                $image_name = $filename;  // Trả về tên file đã đổi
                $_SESSION['success_message'] = '+1 post!';
                return $image_name;
            } else {
                $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
                exit();
            }
        }
    }
}

// query with bind value
function query($pdo, $sql, $parameters = [])
{
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}


// update author
function updateProfile($pdo, $id, $name, $tag, $email, $gender, $dob, $last)
{
    $query = "
    UPDATE users
    SET 
        user_name = :name,
        user_tag = :tag,
        user_dob = :dob,
        user_gender = :gender,
        user_mail = :email,
        account_last_modified = :last
    WHERE user_id = :id";
    $parameters = [":name" => $name, ":tag" => $tag, ":dob" => $dob, ":gender" => $gender, ":email" => $email, ":last" => $last, ":id" => $id];
    query($pdo, $query, $parameters);
}

function GetPostDetail($pdo, $post_id)
{
    $sql = "SELECT * FROM posts
    WHERE post_id = :id";
    $post = $pdo->prepare($sql);
    $post->bindValue(':id', $post_id);
    $post->execute();
    return $post->fetch(PDO::FETCH_ASSOC);
}

function getModuleIdByName($pdo, $module_name)
{
    // Chuẩn bị câu lệnh SQL
    $query = "SELECT module_id FROM modules WHERE module_name = :module_name";

    // Chuẩn bị và thực thi truy vấn
    $statement = $pdo->prepare($query);
    $statement->bindValue(':module_name', $module_name);
    $statement->execute();

    // Lấy kết quả
    $module_id = $statement->fetchColumn();

    // Nếu không tìm thấy module_id thì trả về null
    return $module_id;
}


function sendMailTo($mail, $email, $name, $title, $message)
{
    //Sender
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'duongnnhgch230313@fpt.edu.vn';
    $mail->Password = 'xkxe gurm dpjg msuh';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    //Recipient
    $mail->addAddress($email);
    //Content
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = '<p> User: ' . $name . " is sending u a message: <br>" . $message . '</p>';
    //Send mail
    $mail->send();
}

function getRepostCount( $pdo, $post_id)
{

    // Prepare the SQL query to count reposts for the given post_id
    $query = "SELECT COUNT(*) AS repost_count 
                  FROM posts 
                  WHERE original_post_id = :post_id AND repost_check = 1";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();

    // Fetch the count result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['repost_count'] ?? 0; // Return count or 0 if not found
}


function DeleteAvt($pdo, $user_id) {
    $query = "SELECT avatar FROM users WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":user_id", $user_id);
    $statement->execute();
    $old_avt_path = $statement->fetchColumn();

    if (!empty($old_avt_path) && $old_avt_path != "profile.png") {
        $old_avt_full_path = "../images/avatar/" . $old_avt_path;
        if (file_exists($old_avt_full_path)) {
            unlink($old_avt_full_path);
        } else {
            $_SESSION['error_message'] = "Image is not existed or it could be deleted before";
        }
    }
}

function SetAvtDefault($pdo, $user_id) {
    $new_avt_path = "profile.png";
    $sql = "UPDATE users
        SET avatar = :avatar
        WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':avatar', $new_avt_path);
    $statement->bindValue(':id', $user_id);
    $statement->execute();
    // $_SESSION['success_message'] = "delete avt successfully, your avt has been set to default";

}