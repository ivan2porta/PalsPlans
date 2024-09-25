console.log("dd");

const divSolCirculos3 = document.getElementById("divSolCirculos");
const divSolPlanes = document.getElementById("divSolPlanes");
const divsSolCirculo = document.getElementsByName("divSolCirculo");
const contenidoSolCirculos = document.getElementById("contenidoSolCirculos");
const contenidoSolPlanes = document.getElementById("contenidoSolPlanes");
const botonesAceptarGrupo = document.getElementsByName("bAceptarSolCirculo");


console.log("ddz"); 

window.onload = function () {
    console.log("addd");
    divSolPlanes.addEventListener("click", function () {
        console.log("bbbb");
        mostrarSolicitudesPlanes();
    });

    divSolCirculos3.addEventListener("click", function () {
        mostrarSolicitudesCirculos();
    });

    for (let i = 0; i < botonesAceptarGrupo.length; i++) {
        botonesAceptarGrupo[i].addEventListener("click", function(event) {
            console.log("a");
            if (divsSolCirculo[i]) {
                console.log("c");
                divsSolCirculo[i].classList.add("d-none");
                console.log("d");
            }
        });
    }
}

function mostrarSolicitudesPlanes() {
    contenidoSolCirculos.classList.remove('d-block');
    contenidoSolCirculos.classList.add('d-none');
    contenidoSolPlanes.classList.remove('d-none');
    contenidoSolPlanes.classList.add('d-block');
    divSolPlanes.classList.remove('bg-azul-claro');
    divSolPlanes.classList.add('bg-azul-medio');
    divSolCirculos3.classList.remove('bg-azul-medio');
    divSolCirculos3.classList.add('bg-azul-claro');
}

function mostrarSolicitudesCirculos() {
    contenidoSolPlanes.classList.remove('d-block');
    contenidoSolPlanes.classList.add('d-none');
    contenidoSolCirculos.classList.remove('d-none');
    contenidoSolCirculos.classList.add('d-block');
    divSolCirculos3.classList.remove('bg-azul-claro');
    divSolCirculos3.classList.add('bg-azul-medio');
    divSolPlanes.classList.remove('bg-azul-medio');
    divSolPlanes.classList.add('bg-azul-claro');
}

// function recargarPaginaAlClicFueraDelDiv(divId) {
//     const div = document.getElementById(divId);

//     document.addEventListener("click", function(event) {
//         if (!div.contains(event.target)) {
//             location.reload();
//         }
//     });
// }


