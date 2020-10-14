// Contains helper functions

// Display toast flash message accordingly
function displayToast(message, type) {
    
    let className = "";
    className = (type === "error") ? "red lighten-3 black-text" : "green lighten-3 black-text";

    M.toast({html: message, classes: className});
}