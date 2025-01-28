document.addEventListener('DOMContentLoaded', function () {
    // Get all menu items
    const menuItems = document.querySelectorAll('.service-item');
    // Get all service details
    const serviceDetails = document.querySelectorAll('.service-detail');

    // Function to set the active service and menu item
    function setActiveService(index) {
        // Remove 'active' class from all service details
        serviceDetails.forEach(detail => {
            detail.classList.remove('active');
        });

        // Get the target service detail from the data-target attribute
        const target = menuItems[index].getAttribute('data-target');
        const activeDetail = document.getElementById(target);

        // Add 'active' class to the target service's detail
        if (activeDetail) {
            activeDetail.classList.add('active');
        }

        // Remove 'active' class from all menu items
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('active');
        });

        // Add 'active' class to the clicked menu item
        menuItems[index].classList.add('active');
    }

    // Initially set the first service and menu item as active
    setActiveService(0);

    // Add click event listeners to all menu items
    menuItems.forEach((item, index) => {
        item.addEventListener('click', function () {
            setActiveService(index);
        });
    });
});
