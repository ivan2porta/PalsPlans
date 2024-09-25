const divPlanesC = document.getElementById("divPlanes");
const divMiembros = document.getElementById("divMiembros");
const contenidoPlanes = document.getElementById("contenidoPlanes");
const contenidoMiembros = document.getElementById("contenidoMiembros");
const bcplan = document.getElementById("cplan");
const bcplanMovil = document.getElementById("cplanMovil");
const divCrearPlan = document.getElementById("divCrearPlan");
const divSoliCirculos = document.getElementById("divSolCirculos");
const divSoliPlanes = document.getElementById("divSolPlanes");
const contenidoSoliCirculos = document.getElementById("contenidoSolCirculos");
const contenidoSoliPlanes = document.getElementById("contenidoSolPlanes");
const contenidoEditarCirculos = document.getElementById("divEditarCirculo");
const bEditarCirculo = document.getElementById("bEditarCirculo");
const bEditarCirculoMovil = document.getElementById("bEditarCirculoMovil");

window.onload = function () {
  if (divMiembros) {
    divMiembros.addEventListener("click", function () {
      mostrarMiembros();
    });
  }

  if (divPlanesC) {
    divPlanesC.addEventListener("click", function () {
      mostrarPlanes();
    });
  }

  if (bcplan) {
    bcplan.addEventListener("click", function () {
      crearPlan();
    });
  }

  if (bcplanMovil) {
    bcplanMovil.addEventListener("click", function () {
      crearPlan();
    });
  }

  if (divSoliPlanes) {
    divSoliPlanes.addEventListener("click", function () {
      mostrarSolicitudesPlanes();
    });
  }

  if (divSoliCirculos) {
    divSoliCirculos.addEventListener("click", function () {
      mostrarSolicitudesCirculos();
    });
  }

  if (bEditarCirculo) {
    bEditarCirculo.addEventListener("click", function(){
      editarCirculo();
    });
  }

  if (bEditarCirculoMovil) {
    bEditarCirculoMovil.addEventListener("click", function(){
      editarCirculo();
    });
  }
};

function mostrarMiembros() {
  if (contenidoPlanes) {
    contenidoPlanes.classList.remove("d-block");
    contenidoPlanes.classList.add("d-none");
  }
  if (contenidoMiembros) {
    contenidoMiembros.classList.remove("d-none");
    contenidoMiembros.classList.add("d-block");
  }
  if (divMiembros) {
    divMiembros.classList.remove("bg-azul-claro");
    divMiembros.classList.add("bg-azul-medio");
  }
  if (divPlanesC) {
    divPlanesC.classList.remove("bg-azul-medio");
    divPlanesC.classList.add("bg-azul-claro");
  }
  if (divCrearPlan) {
    divCrearPlan.classList.remove("d-block");
    divCrearPlan.classList.add("d-none");
  }
  if (contenidoEditarCirculos) {
    contenidoEditarCirculos.classList.remove("d-block");
    contenidoEditarCirculos.classList.add("d-none");
  }
}

function mostrarPlanes() {
  if (contenidoMiembros) {
    contenidoMiembros.classList.remove("d-block");
    contenidoMiembros.classList.add("d-none");
  }
  if (contenidoPlanes) {
    contenidoPlanes.classList.remove("d-none");
    contenidoPlanes.classList.add("d-block");
  }
  if (divPlanesC) {
    divPlanesC.classList.remove("bg-azul-claro");
    divPlanesC.classList.add("bg-azul-medio");
  }
  if (divMiembros) {
    divMiembros.classList.remove("bg-azul-medio");
    divMiembros.classList.add("bg-azul-claro");
  }
  if (divCrearPlan) {
    divCrearPlan.classList.remove("d-block");
    divCrearPlan.classList.add("d-none");
  }
  if (contenidoEditarCirculos) {
    contenidoEditarCirculos.classList.remove("d-block");
    contenidoEditarCirculos.classList.add("d-none");
  }
}

function crearPlan() {
  if (divCrearPlan) {
    divCrearPlan.classList.remove("d-none");
    divCrearPlan.classList.add("d-block");
  }
  if (contenidoMiembros) {
    contenidoMiembros.classList.remove("d-block");
    contenidoMiembros.classList.add("d-none");
  }
  if (contenidoPlanes) {
    contenidoPlanes.classList.remove("d-block");
    contenidoPlanes.classList.add("d-none");
  }
  if (divPlanesC) {
    divPlanesC.classList.add("bg-azul-claro");
    divPlanesC.classList.remove("bg-azul-medio");
  }
  if (divMiembros) {
    divMiembros.classList.remove("bg-azul-medio");
    divMiembros.classList.add("bg-azul-claro");
  }
  if (contenidoEditarCirculos) {
    contenidoEditarCirculos.classList.remove("d-block");
    contenidoEditarCirculos.classList.add("d-none");
  }
}

function editarCirculo() {
  if (divCrearPlan) {
    divCrearPlan.classList.remove("d-block");
    divCrearPlan.classList.add("d-none");
  }
  if (contenidoMiembros) {
    contenidoMiembros.classList.remove("d-block");
    contenidoMiembros.classList.add("d-none");
  }
  if (contenidoPlanes) {
    contenidoPlanes.classList.remove("d-block");
    contenidoPlanes.classList.add("d-none");
  }
  if (divPlanesC) {
    divPlanesC.classList.add("bg-azul-claro");
    divPlanesC.classList.remove("bg-azul-medio");
  }
  if (divMiembros) {
    divMiembros.classList.remove("bg-azul-medio");
    divMiembros.classList.add("bg-azul-claro");
  }
  if (contenidoEditarCirculos) {
    contenidoEditarCirculos.classList.remove("d-none");
    contenidoEditarCirculos.classList.add("d-block");
  }
}
