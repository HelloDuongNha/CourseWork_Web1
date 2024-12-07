<?php
// Hiển thị thông báo nếu có lỗi từ session
session_start();
session_destroy();
if (isset($_SESSION['error_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('fail', '"  . $_SESSION['error_message'] . "');
            }
        </script>";
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('success', '" . $_SESSION['success_message'] . "');
            }
        </script>";
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="../css/custom_alert_style.css">
    <link rel="stylesheet" href="../css/sign_up_modal.css">

</head>

<body>
    <div id="custom-alert" class="alert alert-success" role="alert">Đây là thông báo tùy chỉnh với hiệu ứng rơi xuống và kéo lên!</div>
    <!-- Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Register New Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form đăng ký -->
                    <form action="register_query.php" method="POST">
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label align-right">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="usertag" class="col-sm-2 col-form-label align-right">Usertag</label>
                            <div class="col-sm-10">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" name="usertag" placeholder="usertag" aria-label="Usertag" aria-describedby="addon-wrapping" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <legend class="col-sm-2 col-form-label align-right">Gender</legend>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Other" required>
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="calendar_input" class="col-sm-2 col-form-label align-right">Date of Birth</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="calendar_input" name="dob" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label align-right">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" required />
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="password" class="col-sm-2 col-form-label text-end">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" minlength="6" maxlength="20" required />
                            </div>
                            <span style="color: white; margin-left: 150px" class="form-text">
                                Must be 6-20 characters long.
                            </span>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="confirm_password" class="col-sm-2 col-form-label text-end">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="confirm_password" required />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="register_btn">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="logo-section">
            <img src="../images/2022-Greenwich-White-Eng.png" alt="Logo">
        </div>
        <div class="form-section">
            <h1>Join today
                <br><span class="badge text-bg-secondary">to know what is happening now.</span>
            </h1>
            <div class="login-form">
                <form action="validate.php" method="POST">
                    <hr style="border-top:1px groovy #000;">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" placeholder="User-tag/Email">
                        <label style="color: #000;" for="floatingUserTag">User-tag/Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <label style="color: #000;" for="floatingPassword">Password</label>
                    </div>
                    <br />
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button class="btn btn-outline-primary" name="login">Login</button>
                    <!-- <a href="index.php">Login</a> -->
                </form>
            </div>
            <p>Don't have an account? <a id="RegisterBtn" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></p>
        </div>

        <script>
            // Hạn chế ngày trong lịch không được lớn hơn ngày hôm nay
            document.getElementById('calendar_input').addEventListener('input', function() {
                const today = new Date().toISOString().split('T')[0]; // Lấy ngày hôm nay
                if (this.value > today) {
                    alert("You cannot select a date in the future.");
                    this.value = ''; // Reset giá trị nếu chọn ngày không hợp lệ
                }
            });

            // Function to show custom alert
            function showCustomAlert(situation, notice) {
                const alertBox = document.getElementById('custom-alert');

                // Cập nhật nội dung thông báo
                alertBox.textContent = notice;

                // Xóa các class cũ để đảm bảo hiệu ứng mới hoạt động
                alertBox.classList.remove('hide');
                alertBox.classList.add('show');

                // Xử lý màu sắc dựa trên tình huống
                if (situation === 'success') {
                    alertBox.style.backgroundColor = '#4caf50'; // Màu xanh lá cho thành công
                } else if (situation === 'fail') {
                    alertBox.style.backgroundColor = '#f44336'; // Màu đỏ cho thất bại
                } else {
                    alertBox.style.backgroundColor = '#007bff'; // Màu mặc định (xanh dương) cho thông báo khác
                }

                // Sau 3 giây, bắt đầu hiệu ứng kéo lên
                setTimeout(() => {
                    alertBox.classList.remove('show');
                    alertBox.classList.add('hide');
                }, 3500); // Thời gian hiển thị alert (3 giây)
            }
        </script>
    </div>
</body>

</html>