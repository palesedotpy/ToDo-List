
popUp = document.getElementById("pop-up");
var settingsAreOpen = false;
/* Aggiungere animazione all'apertura delle impostazioni */

function hideSettings() {
    
}
function showSettings() {

    let container = document.getElementById("container");
    let gameContainer = document.getElementById("game-container");

    popUp.style.display = "flex";
    document.body.style.backgroundColor = "gray";
    container.style.backgroundColor = "gray";
    gameContainer.style.boxShadow = "none";
    
}

function toggleSettings() {
    if (!settingsAreOpen) {
        showSettings();
    }
    else {
        hideSettings();
    }
    settingsAreOpen = !settingsAreOpen;

    player1InputField.value = player1.name;
    player2InputField.value = player2.name;
}
window.toggleSettings = toggleSettings;