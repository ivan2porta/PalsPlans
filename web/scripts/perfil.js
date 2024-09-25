document.addEventListener("DOMContentLoaded", function () {
    const divPlanes = document.getElementById("divPlanes");
    const divCirculos = document.getElementById("divCirculos");
    const contenidoPlanes = document.getElementById("contenidoPlanes");
    const contenidoCirculos = document.getElementById("contenidoCirculos");
    const bEditarPerfil = document.getElementById("bEditarPerfil");
    const divEditarPerfil = document.getElementById("divEditarPerfil");

    if (divCirculos) {
        divCirculos.addEventListener("click", function () {
            console.log("a");
            mostrarCirculos();
        });
    }

    if (divPlanes) {
        divPlanes.addEventListener("click", function () {
            console.log("b");
            mostrarPlanes();
        });
    }

    if (bEditarPerfil) {
        bEditarPerfil.addEventListener("click", function () {
            console.log("c");
            editarPerfil();
        });
    }

    function mostrarCirculos() {
        if (contenidoPlanes) {
            contenidoPlanes.classList.remove("d-block");
            contenidoPlanes.classList.add("d-none");
        }
        if (divEditarPerfil) {
            divEditarPerfil.classList.remove("d-block");
            divEditarPerfil.classList.add("d-none");
        }
        if (contenidoCirculos) {
            contenidoCirculos.classList.remove("d-none");
            contenidoCirculos.classList.add("d-block");
        }
        if (divCirculos) {
            divCirculos.classList.remove("bg-azul-claro");
            divCirculos.classList.add("bg-azul-medio");
        }
        if (divPlanes) {
            divPlanes.classList.remove("bg-azul-medio");
            divPlanes.classList.add("bg-azul-claro");
        }
    }

    function mostrarPlanes() {
        if (contenidoCirculos) {
            contenidoCirculos.classList.remove("d-block");
            contenidoCirculos.classList.add("d-none");
        }
        if (divEditarPerfil) {
            divEditarPerfil.classList.remove("d-block");
            divEditarPerfil.classList.add("d-none");
        }
        if (contenidoPlanes) {
            contenidoPlanes.classList.remove("d-none");
            contenidoPlanes.classList.add("d-block");
        }
        if (divPlanes) {
            divPlanes.classList.remove("bg-azul-claro");
            divPlanes.classList.add("bg-azul-medio");
        }
        if (divCirculos) {
            divCirculos.classList.remove("bg-azul-medio");
            divCirculos.classList.add("bg-azul-claro");
        }
    }

    function editarPerfil() {
        if (contenidoPlanes) {
            contenidoPlanes.classList.remove("d-block");
            contenidoPlanes.classList.add("d-none");
        }
        if (contenidoCirculos) {
            contenidoCirculos.classList.remove("d-block");
            contenidoCirculos.classList.add("d-none");
        }
        if (divCirculos) {
            divCirculos.classList.remove("bg-azul-medio");
            divCirculos.classList.add("bg-azul-claro");
        }
        if (divPlanes) {
            divPlanes.classList.remove("bg-azul-medio");
            divPlanes.classList.add("bg-azul-claro");
        }
        if (divEditarPerfil) {
            divEditarPerfil.classList.remove("d-none");
            divEditarPerfil.classList.add("d-block");
        }
    }
});