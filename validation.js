const username = document.getElementById('username');
const password = document.getElementById('password');
const form = document.getElementById('form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    const usernameValue = username.value;
    const passwordValue = password.value.trim();

    if (usernameValue === ''){
        setErrorFor(username, 'Username cannot be blank');
    } else {

    }

    if (passwordValue === '') {
    } else {

    }

}

function setErrorFor(input, message) {
    const formControl = input.parseElement;
    const small = formControl.querySelector('small');

    small.innerText = message;
    
    formControl.className = 'form-control error';
}