<aside class="aside-right">



    <div class="other-user">
        <div class="search-container">
            <div class="search-box">
                <div class="relative">
                    <input type="text" class="search-input" placeholder="Search anything...">
                    <div class="search-icon">
                        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
        <h2>Other user:</h2>
        <nav>
            <ul>
                <?php
                include '../includes/DatabaseConnection.php';
                include_once '../includes/Functions.php';
                $users = GetAllUser($pdo);
                foreach ($users as $user): ?>
                    <li class="menu-item right-sidebar">
                        <img style="height: 30px; width: 30px;" src="../avatar/<?= !empty($user['avatar']) ? $user['avatar'] : 'profile.png' ?>" alt="avatar">
                        <p>@<?= $user['user_tag'] ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
</aside>