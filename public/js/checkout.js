let spinner = document.querySelector('.loader');
let payButton = document.getElementById('paybutton');
let btnText = document.querySelector('.text');
let locationDiv = document.getElementById('location-hidden');
let address = document.getElementById('addressByText');

//spinner animation onclick
function activate() {
    spinner.classList.remove('d-none');
    btnText.remove();
}

//get the location on user
function showAddressViaMap() {
    let addressValue = address.value;
    let replacedAddress = addressValue.replace(/\s/g, '%20');
    let map = document.getElementById('gmap_canvas');
    map.setAttribute('src', 'https://maps.google.com/maps?q=' + replacedAddress + '&t=&z=13&ie=UTF8&iwloc=&output=embed')
}

window.onload = () => {
    showAddressViaMap();
}
