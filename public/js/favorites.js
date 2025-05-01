// Check if script loaded
console.log('Favorites script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up favorite buttons');
    
    // Setup favorite buttons with debug
    const favoriteButtons = document.querySelectorAll('.action-btn.favorite');
    console.log('Found favorite buttons:', favoriteButtons.length);
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            const postId = this.getAttribute('data-post-id');
            console.log('Clicked favorite for post:', postId);
            
            // Check for CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            
            // Send AJAX request
            fetch(`/favorite/${postId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                
                // Update button state
                if (data.status) {
                    this.classList.add('active');
                    this.querySelector('i').classList.remove('bi-star');
                    this.querySelector('i').classList.add('bi-star-fill');
                    this.setAttribute('title', 'Hapus dari favorit');
                } else {
                    this.classList.remove('active');
                    this.querySelector('i').classList.remove('bi-star-fill');
                    this.querySelector('i').classList.add('bi-star');
                    this.setAttribute('title', 'Tambahkan ke favorit');
                }
                
                showToast(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    });
});

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}