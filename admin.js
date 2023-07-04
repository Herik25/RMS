var login = document.getElementById('login');
        var but = document.getElementById('home');
        var sub = document.getElementById('sub');
        console.log(log);
        if (log === "loged in") {
            window.location.href = '/RMS/adminPanel.php';
        }

        function home(){
            window.location.href = '/RMS/';
        }