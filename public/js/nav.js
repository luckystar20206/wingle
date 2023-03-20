let menu = document.getElementById('menu');
let navitems = document.getElementById("navitems");

menu.addEventListener('click', () => {
    navitems.classList.toggle("show");
    menu.classList.toggle("white");
})