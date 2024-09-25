export function validarCorreoElectronico(correo) {
    const regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const esCorreoValido = regexCorreo.test(correo);
    if (esCorreoValido) {
      return true;
    } else {
        return false;
    }
  }

  export function validarNombre(nombre) {
    var regex = /^[A-ZÁÉÍÓÚÑÜÇ][a-záéíóúñüç]*(\s[A-ZÁÉÍÓÚÑÜÇ][a-záéíóúñüç]*)*$/;
    // Verificar si el nombre coincide con la expresión regular
    if (regex.test(nombre)) {
        return true; 
    } else {
        return false;
    }
}

export function validarPassword(pass) {
    const mayus = document.getElementById("mayus");
    const minus = document.getElementById("minus");
    const num = document.getElementById("num");
    const especial = document.getElementById("especial");
    const longitud = document.getElementById("longitud");

    let contieneMayus = /[A-Z]/.test(pass);

    let contieneMinus = /[a-z]/.test(pass);

    let contieneNum = /[0-9]/.test(pass);

    let contieneEspecial = /[@,.\-_/!?*^<>¿=)(&%$"]/.test(pass);

    let longitudValida = pass.length >= 8 && pass.length <= 16;

    mayus.classList.toggle("text-success", contieneMayus);
    minus.classList.toggle("text-success", contieneMinus);
    num.classList.toggle("text-success", contieneNum);
    especial.classList.toggle("text-success", contieneEspecial);
    longitud.classList.toggle("text-success", longitudValida);

    if(contieneMayus && contieneMinus && contieneNum && contieneEspecial && longitudValida){
      document.getElementById("pass").classList.add("is-valid");
      if(document.getElementById("pass2").value === pass){
        document.getElementById("pass2").classList.remove("is-invalid");
        document.getElementById("pass2Mal").innerText="";
      }
    }else{
      document.getElementById("pass").classList.remove("is-valid");
    }
}

export function validarFecha(fechaString) {
    const hoy = new Date();
    const fecha = new Date(fechaString);
    return (
      !isNaN(fecha.getTime()) &&
      fecha.toISOString().slice(0, 10) === fechaString &&
      fecha < hoy
    );
}

function toogleMobileMenu(element){
  console.log("aa");
  element.classList.toggle("open");
}








