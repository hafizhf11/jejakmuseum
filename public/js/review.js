document.addEventListener('DOMContentLoaded', function() {
    // Toggle untuk form edit review
    const toggleEditBtn = document.getElementById('toggleEditForm');
    const editReviewForm = document.getElementById('editReviewForm');
    const cancelEditBtn = document.getElementById('cancelEdit');
    
    if (toggleEditBtn && editReviewForm) {
        toggleEditBtn.addEventListener('click', function() {
            console.log('Edit button clicked'); // Debugging
            editReviewForm.style.display = 'block';
            toggleEditBtn.closest('.bg-light').style.display = 'none';
        });
    }
    
    if (cancelEditBtn && editReviewForm) {
        cancelEditBtn.addEventListener('click', function() {
            editReviewForm.style.display = 'none';
            document.querySelector('.review-form-container .bg-light').style.display = 'block';
        });
    }

    // Character counter untuk textarea
    const commentField = document.getElementById('comment');
    const charCounter = document.getElementById('char-count');

    if (commentField && charCounter) {
        commentField.addEventListener('input', function() {
            charCounter.textContent = this.value.length;
        });
    }
    
    // Edit button pada UI baru (seperti di gambar)
    const editButton = document.querySelector('.edit-review-btn');
    if (editButton) {
        editButton.addEventListener('click', function() {
            console.log('Pencil edit button clicked');
            const reviewForm = document.getElementById('editReviewForm');
            const reviewDisplay = document.querySelector('.user-review-display');
            
            if (reviewForm && reviewDisplay) {
                reviewForm.style.display = 'block';
                reviewDisplay.style.display = 'none';
            }
        });
    }
});