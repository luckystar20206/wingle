let menu = document.getElementById('menu');

menu.onclick = () => {
    let sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('show');
    menu.style.zIndex = "100";
    
}
