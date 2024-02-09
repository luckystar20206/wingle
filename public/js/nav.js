
let menu = document.getElementById('menu');
let navitems = document.getElementById("navitems");

menu.addEventListener('click', () => {
    navitems.classList.toggle("show");
    menu.classList.toggle("white");
})

navitems.addEventListener('click', () => {
    navitems.classList.remove('show');
    menu.classList.remove("white");
})
