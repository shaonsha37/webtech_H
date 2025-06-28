    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 E-Commerce Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Clean up session messages after page load
        document.addEventListener('DOMContentLoaded', function() {
            // Clear session messages after they're displayed
            <?php if(isset($_SESSION['success'])): ?>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['error'])): ?>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['errors'])): ?>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html> 