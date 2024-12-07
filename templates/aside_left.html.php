<aside class="aside-left">
    <div class="logo">
        <a href="">
            <img src="../icon/Greenwich.png" alt="Logo">
        </a>
    </div>

    <div class="menu">
    <nav>
        <ul>
            <li class="menu-item">
                <input type="radio" id="menu-item-1" name="menu-item">
                <a href="../Profile/allPostProfile.php">
                    <img class="post-avatar" src="../avatar/<?=$_SESSION['user_avt']?>" >
                    <p><?= $_SESSION['user_id'] ?></p>
                </a>
            </li>
            <li class="menu-item">
                <input type="radio" id="menu-item-2" name="menu-item" checked>
                <a href="../Homepage/homepage.php">
                    <img src="../icon/home.png" alt="Home">Homepage
                </a>
            </li>
            <li class="menu-item">
                <input type="radio" id="menu-item-3" name="menu-item">
                <a href="#">
                    <img src="../icon/email.png" alt="contact">Contact us
                </a>
            </li>
            <li class="menu-item">
                <input type="radio" id="menu-item-4" name="menu-item">
                <a href="#">
                    <img src="../icon/setting.png" alt="setting">Settings
                </a>
            </li>
            <li class="menu-item">
                <input type="radio" id="menu-item-5" name="menu-item">
                <a href="../Log in/logout.php">
                    <img src="../icon/logout.png" alt="logout">Logout
                </a>
            </li>
            <li class="menu-item" >
                <input type="radio" id="menu-item-6" name="menu-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#postModal">
                    <img src="../icon/edit.png" alt="create"> Create new post
                </a>
            </li>
        </ul>
    </nav>
</div>
</aside>

<script>
    document.querySelectorAll('.menu-item a').forEach((item, index) => {
    item.addEventListener('click', function(event) {
        // Ngăn không cho liên kết dẫn tới trang mới
        event.preventDefault();

        // Đánh dấu radio tương ứng với menu item đó
        const radio = document.querySelectorAll('.menu-item input[type="radio"]')[index];
        radio.checked = true;

        // Nếu menu item có liên kết (href), bạn có thể thay đổi trang
        if (item.getAttribute('href') !== '#') {
            window.location.href = item.getAttribute('href');
        }
    });
});
</script>