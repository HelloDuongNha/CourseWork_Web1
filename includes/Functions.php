<?php
require "DatabaseConnection.php";

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
        ON posts.module_id = main_module.module_id -- Đổi tên join modules thành main_module
    LEFT JOIN 
        modules AS repost_module 
        ON posts.repost_module_id = repost_module.module_id
    LEFT JOIN 
        users AS users_repost 
        ON posts.repost_user_id = users_repost.user_id
    ORDER BY 
        COALESCE(posts.repost_date, CONCAT(posts.post_created_day, ' ', posts.post_created_time)) DESC
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
        COALESCE(posts.repost_date, CONCAT(posts.post_created_day, ' ', posts.post_created_time)) DESC
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
        COALESCE(posts.repost_date, CONCAT(posts.post_created_day, ' ', posts.post_created_time)) DESC
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

function CheckUploadImage($file)
{
    // Kiểm tra và xử lý ảnh
    $image_name = NULL; // Mặc định là NULL nếu không có ảnh
    if (isset($file) && $file['error'] === 0) {
        $upload_dir = '../uploaded_imgs/';  // Thư mục lưu ảnh
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
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Kiểm tra file size (Max: 5MB)
        if ($file["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    return $image_name;  // Trả về tên file hoặc NULL nếu có lỗi
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
    return $post->fetch(PDO::FETCH_ASSOC); //tôi đoán là sẽ dùng fetch này
}
