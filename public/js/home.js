let d = document;
let modal = d.getElementById('modal');
let dropdownArea = d.querySelector('.dropdown-area');
let dropdownContent = d.querySelector('.dropdown-content');
let arrowUp = d.querySelector('.arrow-up');
let modalContent = d.getElementsByClassName('modal-content');
let select = d.getElementById('select');
let selectArea = d.getElementById('select-area');
let alertSuccess = d.getElementById('alert-success');
let locateButton = document.getElementById('locate-button');
let map = d.getElementById("map");
setTimeout(() => {
    alertSuccess.style.display = "none"
}, 5000)

function disableAlert(){
    document.querySelector(".alert-red").remove();
}

dropdownArea.addEventListener('click', ()=>{
    dropdownContent.classList.toggle('d-none');
    arrowUp.classList.toggle("bi-chevron-up")
})
