function validar() {
    var nom, pas;

    nom = document.getElementById("nom").value;
    pas = document.getElementById("pas").value;

    if (nom === "") {
        alert("Ingrese un Usuario");
        return false;
    }
    else if (pas === "") {
        alert("Ingrese una Contraseña");
        return false;
    }

}