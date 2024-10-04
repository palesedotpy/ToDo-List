
copyButton = document.getElementById("copy-task-button");

function copyToClipboard(inputId) {
    taskText = document.getElementById(inputId).textContent;
    navigator.clipboard.writeText(taskText.trim());
}