document.addEventListener('DOMContentLoaded', function() {
    // Function to initialize sidebar icons
    function initSidebarIcons() {
        // Get all submenu items with data-icon attribute
        const menuItems = document.querySelectorAll('.submenu-item[data-icon]');
        
        menuItems.forEach(item => {
            // Get the icon from data-icon attribute
            const icon = item.getAttribute('data-icon');
            
            // Create icon element if it doesn't exist
            if (!item.querySelector('.menu-icon')) {
                const iconElement = document.createElement('span');
                iconElement.className = 'menu-icon';
                iconElement.textContent = icon;
                iconElement.style.marginRight = '8px';
                
                // Insert the icon before the text
                item.insertBefore(iconElement, item.firstChild);
            }
        });
    }

    // Initialize icons immediately
    initSidebarIcons();

    // Re-initialize icons after a short delay to catch any dynamically loaded content
    setTimeout(initSidebarIcons, 500);
    
    // Also re-initialize when the window is resized (in case of layout changes)
    window.addEventListener('resize', initSidebarIcons);
});
