const correo = document.getElementById("mail");
const contrasenia = document.getElementById("pass");
const bReg = document.getElementById("bReg");
const login = document.getElementById("login");
const reg = document.getElementById("reg");
const bLogin2 = document.getElementById("bLogin2");

window.onload = function () {

    bReg.addEventListener("click", function (event) {
        cambiarPantalla();
    });

    bLogin2.addEventListener("click", function (event) {
        console.log("aa");
        cambiarPantalla2();
    });
}

function cambiarPantalla() {
    if (login.classList.contains('d-flex')) {
      login.classList.remove('d-flex');
      login.classList.add('d-none');
    }
  
    if (reg.classList.contains('d-none')) {
      reg.classList.remove('d-none');
      reg.classList.add('d-flex');
    }
  }

  function cambiarPantalla2() {
      login.classList.remove('d-none');
      login.classList.add('d-flex');
      reg.classList.remove('d-flex');
      reg.classList.add('d-none');
    
  }
  

