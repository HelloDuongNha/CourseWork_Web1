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

function GetAllPosts($pdo)
{
    $sql = "SELECT *, user_name, user_tag, user_mail, post_caption, post_created_day, repost_check, repost_caption, repost_date, repost_user_tag, repost_user_name FROM posts
    INNER JOIN users
    ON posts.user_id = users.user_id
                ORDER BY 
                -- Nếu bài viết là repost, sử dụng repost_date, nếu không thì dùng post_created_day
                COALESCE(posts.repost_date, CONCAT(posts.post_created_day, ' ', posts.post_created_time)) DESC
    -- INNER JOIN categories
    -- ON jokes.category_id = categories.category_id
    ";
    //execute (run) SQL and save result to an array
    $posts = $pdo->query($sql);
    return $posts->fetchall();
}

function GetAllUser($pdo)
{
    $sql = "SELECT * FROM users;";
    $users = $pdo->query($sql);
    return $users->fetchall();
}