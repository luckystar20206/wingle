let spinner = document.querySelector('.loader');
let payButton = document.getElementById('paybutton');
let btnText = document.querySelector('.text');
let locationDiv = document.getElementById('location-hidden');

payButton.addEventListener('click', ()=>{
    spinner.classList.remove('d-none');
    btnText.remove();
    payButton.setAttribute('disabled');
})

//spinner animation onclick
function activate(){
    spinner.classList.remove('d-none');
    text.remove();
}

//get the location on user
function getLocation(){
    if(navigator.geolocation){
        let currentLocation = navigator.geolocation.getCurrentPosition(showPosition);
    }else{
        alert('Geolocation is not supported in this browser');
    }
}
function showPosition(position){
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;
    let input = document.createElement('input');
    input.setAttribute('type' , 'hidden');
    input.setAttribute('value', [latitude, longitude]);
    locationDiv.appendChild(input);
    console.log(latitude, longitude);
}

window.onload = () => {
    getLocation();
    showPosition();
}
