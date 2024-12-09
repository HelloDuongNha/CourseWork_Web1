<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .icon-button {
        display: inline-block;
        border-radius: 8px; /* Bo viền */
        padding: 5px;
        transition: background-color 0.3s, transform 0.3s; /* Chuyển động mượt mà */
    }

    .icon-button:hover {
        background-color: rgba(0, 0, 0, 0.1); /* Màu nền khi hover */
        transform: translateY(-5px); /* Di chuyển hình ảnh lên */
    }

    .icon-button img {
        transition: transform 0.3s; /* Hiệu ứng mượt mà cho hình ảnh */
    }

    .icon-button:hover img {
        transform: translateY(-3px); /* Di chuyển hình ảnh lên khi hover */
    }
</style>
</head>
<body>
<div style="display: flex; flex-direction: row; gap:10px;">
    <a href="" class="icon-button">
        <img style="width: 30px; height: 30px;" src="../icon/edit_post.png" alt="edit">
    </a>
    <form action="../Delete_Post/delete_post.php" method="post"
        onsubmit="return confirm('Are you sure to delete this Post?');">
        <a href="" class="icon-button">
            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
            <button type="submit" style="background: none; border: none; padding: 0;">
                <img style="width: 30px; height: 30px;" src="../icon/delete.png" alt="delete">
            </button>
        </a>
    </form>
</div>
</body>
</html>