document.addEventListener("DOMContentLoaded", function () {
  const divMiembros = document.getElementById("divMiembros");
  const contenidoMiembros = document.getElementById("contenidoMiembros");
  const beplan = document.getElementById("bEditarPlan");
  const divEditarPlan = document.getElementById("divEditarPlan");

  const urlParams = new URLSearchParams(window.location.search);
  const ubi = urlParams.get('u');
  const f = urlParams.get('f');
  const date = new Date(f);
  const unixTimestamp = Math.floor(date.getTime() / 1000);
  let ptemp = document.getElementById("ptemp");
  let pcli = document.getElementById("pcli");

  const url = `http://api.openweathermap.org/data/2.5/weather?q=${ubi}&lang=es&appid=d8bd6f1aecfdb0126527799e2678ee10&dt=${unixTimestamp}&units=metric`;

  fetch(url)
      .then(response => response.json())
      .then(data => {
          let temp = Math.round(data.main.temp);
          let cli = data.weather[0].description[0].toUpperCase() + data.weather[0].description.slice(1);
          if (ptemp) ptemp.textContent = `Temperatura: ${temp} °C`;
          if (pcli) pcli.textContent = `Clima: ${cli}`;
      })
      .catch(error => {
          console.log(error);
      });

  if (divMiembros) {
      divMiembros.addEventListener("click", function () {
          mostrarMiembros();
      });
  }

  if (beplan) {
      beplan.addEventListener("click", function () {
          editarPlan();
      });
  }

  function mostrarMiembros() {
      if (contenidoMiembros) {
          contenidoMiembros.classList.remove("d-none");
          contenidoMiembros.classList.add("d-block");
      }
      if (divMiembros) {
          divMiembros.classList.remove("bg-azul-claro");
          divMiembros.classList.add("bg-azul-medio");
      }
      if (divEditarPlan) {
          divEditarPlan.classList.remove("d-block");
          divEditarPlan.classList.add("d-none");
      }
  }

  function editarPlan() {
      if (contenidoMiembros) {
          contenidoMiembros.classList.remove("d-block");
          contenidoMiembros.classList.add("d-none");
      }
      if (divMiembros) {
          divMiembros.classList.remove("bg-azul-medio");
          divMiembros.classList.add("bg-azul-claro");
      }
      if (divEditarPlan) {
          divEditarPlan.classList.remove("d-none");
          divEditarPlan.classList.add("d-block");
      }
  }
});
