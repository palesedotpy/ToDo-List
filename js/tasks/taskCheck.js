
checkButtons = document.getElementsByClassName("taskCheck");
taskLabels = document.getElementsByClassName("taskLabel");

for (let i=0; i<checkButtons.length; i++) {
    checkButtons[i].addEventListener("change", function() {
        if (checkButtons[i].checked) {
            taskLabels[i].style.textDecoration = "line-through";
        } 
        else {
            taskLabels[i].style.textDecoration = "none";

        }   
    });
}