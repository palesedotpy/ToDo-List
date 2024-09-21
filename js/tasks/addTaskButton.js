
const inputTask = document.getElementById("input-task");
const addTaskButton = document.getElementById("add-task-button");

const errorMex = document.getElementById("errorMex");


function toggleButtonState() {
    // Check if the input field is empty
    if (inputTask.value.trim() === "") {
        addTaskButton.disabled = true;  // Disable the button
    } 
    else if (inputTask.value.trim().length > 255) {
        errorMex.innerText = "Maximum 255 characters";
        addTaskButton.disabled = true;
    }
    else {
        errorMex.innerText = "";
        addTaskButton.disabled = false; // Enable the button
    }
}

inputTask.addEventListener("input", toggleButtonState);