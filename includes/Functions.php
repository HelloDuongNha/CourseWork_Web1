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
    $sql = "
    SELECT 
        posts.post_id,
        posts.post_caption,
        posts.post_created_day,
        posts.post_created_time,
        posts.post_last_modified,
        posts.repost_check,
        posts.repost_date,
        posts.repost_caption,
        posts.img_path,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
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
        posts.post_id,
        posts.post_caption,
        posts.post_created_day,
        posts.post_created_time,
        posts.post_last_modified,
        posts.repost_check,
        posts.repost_date,
        posts.repost_caption,
        posts.img_path,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
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
        posts.post_id,
        posts.post_caption,
        posts.post_created_day,
        posts.post_created_time,
        posts.post_last_modified,
        posts.repost_check,
        posts.repost_date,
        posts.repost_caption,
        posts.img_path,
        users_main.user_name AS main_user_name,
        users_main.user_tag AS main_user_tag,
        users_main.user_mail AS main_user_mail,
        users_main.avatar AS main_avatar,
        users_repost.user_name AS repost_user_name,
        users_repost.user_tag AS repost_user_tag,
        users_repost.avatar AS repost_avatar
    FROM 
        posts
    INNER JOIN 
        users AS users_main 
        ON posts.user_id = users_main.user_id
    LEFT JOIN 
        users AS users_repost 
        ON posts.repost_user_id = users_repost.user_id
    WHERE posts.repost_user_id = :repost_user_id
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
    return $user->fetchall();
}
