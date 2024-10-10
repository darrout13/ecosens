function validarFormulario() {
    var usuario = document.getElementById("usuario").value;
    var contrasena = document.getElementById("contrasena1").value;
    var confirmarContrasena = document.getElementById("confirmar-contrasena").value;
    var telefono = document.getElementById("tel1").value;

    // Validación de la contraseña
    if (contrasena.length < 9) {
        alert("La contraseña debe tener al menos 9 caracteres.");
        return false;
    }

    var contieneNumero = /\d/.test(contrasena);
    if (!contieneNumero) {
        alert("La contraseña debe contener al menos un número.");
        return false;
    }

    var contieneMayuscula = /[A-Z]/.test(contrasena);
    if (!contieneMayuscula) {
        alert("La contraseña debe contener al menos una letra mayúscula.");
        return false;
    }

    var contieneEspecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(contrasena);
    if (!contieneEspecial) {
        alert("La contraseña debe contener al menos un carácter especial.");
        return false;
    }

    if (contrasena !== confirmarContrasena) {
        alert("Las contraseñas no coinciden.");
        return false;
    }

    // Validación del teléfono
    if (telefono.length !== 10 || isNaN(telefono)) {
        alert("El número de teléfono debe contener exactamente 10 números.");
        return false;
    }

   

    return true;
}
