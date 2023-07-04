const list = document.querySelectorAll('li');

function clk() {
    list.forEach((item) => 
        item.classList.remove('active'));
        this.classList.add('active');
}

list.forEach((item) => 
    item.addEventListener('click', clk)
)

function home() {
    window.location.href = '/RMS/';
}