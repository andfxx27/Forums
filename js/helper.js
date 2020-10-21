// Contains helper functions

// Display toast flash message accordingly
function displayToast(message, type) {
    
    let className = "";
    className = (type === "error") ? "red white-text" : "green white-text";

    M.toast({html: message, classes: className});
}