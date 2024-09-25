const btnPlanes = document.getElementById("btnMenuPlanesInicio");
const btnCirculos = document.getElementById("btnMenuCirculosInicio");
const divPlanes = document.getElementById("divPlanesInicio");
const divCirculos = document.getElementById("divCirculosInicio");

window.onload = function () {
    btnPlanes.addEventListener("click", function () {
        mostrarPlanes();
    });

    btnCirculos.addEventListener("click", function () {
        mostrarCirculos();
    });
}

function mostrarPlanes() {
    divCirculos.classList.remove("d-flex");
    divCirculos.classList.add("d-none");
    divPlanes.classList.remove("d-none");
    divPlanes.classList.add("d-flex");
    btnCirculos.classList.remove("bg-azul-medio");
    btnCirculos.classList.add("bg-azul-claro");
    btnPlanes.classList.remove("bg-azul-claro");
    btnPlanes.classList.add("bg-azul-medio");
}

function mostrarCirculos() {
    divPlanes.classList.remove("d-flex");
    divPlanes.classList.add("d-none");
    divCirculos.classList.remove("d-none");
    divCirculos.classList.add("d-flex");
    btnPlanes.classList.remove("bg-azul-medio");
    btnPlanes.classList.add("bg-azul-claro");
    btnCirculos.classList.remove("bg-azul-claro");
    btnCirculos.classList.add("bg-azul-medio");
}