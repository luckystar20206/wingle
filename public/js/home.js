let d = document;
let modal = d.getElementById('modal');
let modalContent = d.getElementsByClassName('modal-content');
let select = d.getElementById('select');
let selectArea = d.getElementById('select-area');

for (let i = 0; i<select.options.length; i++){
    select.options[i].addEventListener('click', ()=>{
        if(select.options[i].value === "selected"){

        }else{
            modal.classList.add('none');
            modal.classList.remove('block');
            console.log(select.options[i].value);

            selectArea.options[0].innerHTML = select.options[i].value
        }
    })
}
