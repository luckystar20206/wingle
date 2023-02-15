let d = document;
let dropdownArea = d.querySelector('.dropdown-area');
let dropdownContent = d.querySelector('.dropdown-content');
let arrowUp = d.querySelector('.arrow-up');

dropdownArea.addEventListener('click', ()=>{
    dropdownContent.classList.toggle('d-none');
    arrowUp.classList.toggle("bi-chevron-up")
})
