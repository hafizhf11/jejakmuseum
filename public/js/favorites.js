document.addEventListener('DOMContentLoaded', function() {
    console.log('Favorites script loaded');
    
    // Setup favorite buttons
    const favoriteButtons = document.querySelectorAll('.action-btn.favorite');
    console.log('Found favorite buttons:', favoriteButtons.length);
    
    if (favoriteButtons.length === 0) return;
    
    // Get CSRF token
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    if (!metaTag) {
        console.error('CSRF token meta tag not found');
        return;
    }
    const csrfToken = metaTag.getAttribute('content');
    
    // Add click event to all favorite buttons
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const postId = this.getAttribute('data-post-id');
            if (!postId) {
                console.error('No post ID found on button');
                return;
            }
            
            console.log('Toggling favorite for post:', postId);
            
            // Create form data for AJAX request
            const formData = new FormData();
            formData.append('_token', csrfToken);
            
            // Send AJAX request
            fetch(`/favorite/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success data:', data);
                
                // Update button state
                if (data.status) {
                    // Added to favorites
                    this.classList.add('active');
                    if (this.querySelector('i')) {
                        this.querySelector('i').className = 'bi bi-star-fill';
                    }
                    this.setAttribute('title', 'Hapus dari favorit');
                } else {
                    // Removed from favorites
                    this.classList.remove('active');
                    if (this.querySelector('i')) {
                        this.querySelector('i').className = 'bi bi-star';
                    }
                    this.setAttribute('title', 'Tambahkan ke favorit');
                    
                    // If we're on the favorites page, remove the card
                    if (window.location.pathname === '/favorites') {
                        const card = this.closest('.col-md-4');
                        if (card) {
                            card.remove();
                            
                            // Check if no more cards
                            if (document.querySelectorAll('.action-btn.favorite').length === 0) {
                                // Reload to show empty state
                                window.location.reload();
                            }
                        }
                    }
                }
                
                // Show notification
                showToast(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    });
    
    // Toast notification function
    function showToast(message) {
        // Remove existing toast if any
        const existingToast = document.querySelector('.toast-notification');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Create new toast
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Show toast with animation
        setTimeout(() => toast.classList.add('show'), 10);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});