<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Alert with Situation and Notice</title>
    <style>
        /* Alert container */
        #custom-alert {
            position: fixed;
            top: -100px; /* Ban đầu ở ngoài màn hình */
            left: 50%;
            transform: translateX(-50%);
            background-color: #4caf50; /* Màu nền (xanh lá) */
            color: white; /* Màu chữ */
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            opacity: 0; /* Ban đầu ẩn */
            z-index: 1000;
            font-family: Arial, sans-serif;
            animation: none; /* Ban đầu không có animation */
        }

        /* Hiển thị alert với hiệu ứng rơi */
        #custom-alert.show {
            animation: drop-down 0.6s ease forwards;
        }

        /* Ẩn alert với hiệu ứng kéo lên */
        #custom-alert.hide {
            animation: slide-up 0.6s ease forwards;
        }

        /* Hiệu ứng rơi xuống */
        @keyframes drop-down {
            0% {
                top: -100px;
                opacity: 0;
            }
            60% {
                top: 30px; /* Rơi xuống vượt mức một chút */
                opacity: 1;
            }
            100% {
                top: 20px; /* Ổn định tại vị trí */
                opacity: 1;
            }
        }

        /* Hiệu ứng kéo lên */
        @keyframes slide-up {
            0% {
                top: 20px;
                opacity: 1;
            }
            100% {
                top: -100px; /* Kéo lên ngoài màn hình */
                opacity: 0;
            }
        }

        /* Style cho nút test */
        button {
            margin-top: 100px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Alert box -->
    <div id="custom-alert">Đây là thông báo tùy chỉnh với hiệu ứng rơi xuống và kéo lên!</div>

    <!-- Buttons để test -->
    <button onclick="showCustomAlert('success', 'Operation successful!')">Hiển thị Alert Success</button>
    <button onclick="showCustomAlert('fail', 'Operation failed!')">Hiển thị Alert Fail</button>
    <button onclick="showCustomAlert('', 'This is a custom notice message.')">Hiển thị Alert Custom</button>

    <script>
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
</body>
</html>
