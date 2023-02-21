let d = document;
let dropdownArea = d.querySelector('.dropdown-area');
let dropdownContent = d.querySelector('.dropdown-content');
let arrowUp = d.querySelector('.arrow-up');
let filterform = d.getElementById('filter-form');

function submitFilterForm(){
    filterform.submit()
}

dropdownArea.addEventListener('click', ()=>{
    dropdownContent.classList.toggle('d-none');
    arrowUp.classList.toggle("bi-chevron-up")
})
