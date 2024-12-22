// Function to show custom alert
function showCustomAlert(situation, notice) {
    const alertBox = document.getElementById('custom-alert');

    // Update the alert content
    alertBox.textContent = notice;

    // Remove old classes to ensure the new effect works
    alertBox.classList.remove('hide');
    alertBox.classList.add('show');

    // Handle color based on the situation
    if (situation === 'success') {
        alertBox.style.backgroundColor = '#4caf50'; // Green for success
    } else if (situation === 'fail') {
        alertBox.style.backgroundColor = '#f44336'; // Red for failure
    } else {
        alertBox.style.backgroundColor = '#007bff'; // Default blue for other notifications
    }

    // After 3 seconds, start the hide animation
    setTimeout(() => {
        alertBox.classList.remove('show');
        alertBox.classList.add('hide');
    }, 3500); // Alert display duration (3 seconds)
}

document.addEventListener("DOMContentLoaded", function () {
    const uploadImageInput = document.getElementById("upload-image");
    const imagePreview = document.getElementById("image-preview");
    const previewImg = document.getElementById("preview-img");
    const uploadButton = document.querySelector(".upload-button");
    const removeImageButton = document.getElementById("remove-image");

    // Trigger file input when clicking the SVG button
    uploadButton.addEventListener("click", (event) => {
        uploadImageInput.click(); // Open file input
    });

    // Display the preview image when the user selects a file
    uploadImageInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result; // Display the selected image
                imagePreview.style.display = "block"; // Show the preview section
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = "#";
            imagePreview.style.display = "none"; // Hide the preview if no image is selected
        }
    });

    // Remove the image and hide the preview when the "x" button is clicked
    removeImageButton.addEventListener("click", function () {
        previewImg.src = "#";
        imagePreview.style.display = "none"; // Hide the preview when removing the image
        uploadImageInput.value = ""; // Reset file input
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const pop_uploadImageInput = document.getElementById("pop-upload-image");
    const pop_imagePreview = document.getElementById("pop-image-preview");
    const pop_previewImg = document.getElementById("pop-preview-img");
    const pop_uploadButton = document.querySelector(".pop-upload-button");
    const pop_removeImageButton = document.getElementById("pop-remove-image");

    // Trigger file input when clicking the SVG button
    pop_uploadButton.addEventListener("click", () => {
        pop_uploadImageInput.click();
    });

    // Display the preview image when the user selects a file
    pop_uploadImageInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                pop_previewImg.src = e.target.result;
                pop_imagePreview.style.display = "block"; // Show the preview section
            };
            reader.readAsDataURL(file);
        } else {
            pop_previewImg.src = "#";
            pop_imagePreview.style.display = "none"; // Hide the preview if no image is selected
        }
    });

    // Remove the image and hide the preview when the "x" button is clicked
    pop_removeImageButton.addEventListener("click", function () {
        pop_previewImg.src = "#";
        pop_imagePreview.style.display = "none"; // Hide the preview when removing the image
        pop_uploadImageInput.value = ""; // Reset file input
    });
});

