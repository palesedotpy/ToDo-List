
const loginButton = document.getElementById("login-button");
const signupButton = document.getElementById("signup-button");

const container = document.getElementById("container");
const button = document.getElementsByClassName("accountButton");

let popUp; 

function openPopUp(popUpId) {
    popUp = document.getElementById(popUpId);

    popUp.style.display = "flex";
    document.body.style.backgroundColor = "#6e6e6e";
    container.style.opacity = "0.3";
    button.backgroundColor = "red";
}
function closePopUp() {
    popUp.style.display = "none";
    document.body.style.backgroundColor = "#F5F5F5";
    container.style.opacity = "1";
}