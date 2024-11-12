const tareaEliminarModal = document.getElementById("tareaEliminarModal");
const closeBtnModal =
  tareaEliminarModal.getElementsByClassName("closeBtn")[0];
const notBtnModal = tareaEliminarModal.getElementsByClassName("notBtn")[0];
const tareaForm = document.forms["tareaForm"];

const eliminarTarea = (id) => {
  const codInput = tareaForm["cod"];
  codInput.value = id;
  tareaEliminarModal.classList.remove("ocultarModal");
};

const cerrarModal = () => {
  tareaEliminarModal.classList.add("ocultarModal");
};

closeBtnModal.addEventListener("click", () => cerrarModal());
notBtnModal.addEventListener("click", () => cerrarModal());


// FILTRAR
function mostrarVentana() {
  document.getElementById('fondoVentana').style.display = 'flex';
}

function cerrarVentana() {
  document.getElementById('fondoVentana').style.display = 'none';
}


// AGRUPAR
function mostrarVentanaAgrupar() {
  document.getElementById('fondoVentanaAgrupar').style.display = 'flex';
}

function cerrarVentanaAgrupar() {
  document.getElementById('fondoVentanaAgrupar').style.display = 'none';
}