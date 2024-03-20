function validateForm() {
    var login = document.getElementById("login").value;
    var passwd = document.getElementById("passwd").value;

    if (login.trim() === '' || passwd.trim() === '') {
        alert("Veuillez remplir tous les champs.");
        return false;
    }
    return true;