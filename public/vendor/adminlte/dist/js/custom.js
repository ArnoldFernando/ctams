document.addEventListener('keydown', function(event) {
    if (event.keyCode === 112) { // F1 key
        event.preventDefault(); // Prevent the default F1 behavior
        window.open("/admin/redirect", "_blank"); // Open the URL in a new tab
    }
});
