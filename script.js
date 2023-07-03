 //admin button
var adminButton = document.getElementById('admin');
adminButton.addEventListener('click', () => {
    history.pushState(null,'','/RMS/admin.php');
    handleRoute();
})

function handleRoute() {
    var path = window.location.pathname;
    var admin = document.getElementById('admin-container')
    if (path === '/RMS/admin.php') {
       window.location.reload();
    } else {
        admin.textContent = '404 Page not found';
    }
}

//add items
