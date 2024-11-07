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