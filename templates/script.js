// Lấy các phần tử cần thiết
var modal = document.getElementById("postModal");
var btn = document.getElementById("createPostBtn");
var span = document.getElementsByClassName("close")[0];

// Mở modal khi nhấn vào "Create new post"
btn.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
}

// Đóng modal khi nhấn vào dấu "X"
span.onclick = function() {
    modal.style.display = "none"; 
}

// Đóng modal khi nhấn ra ngoài modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none"; 
    }
}
