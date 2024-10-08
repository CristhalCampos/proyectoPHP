const formU = document.querySelector("form[name='form-users']");

//Botón "Editar datos" de usuario
const editBtn = formU.querySelector("button[name='edit']");
editBtn.addEventListener("click", function() {
  //Habilitar los campos para edición
  formU.querySelectorAll("input").forEach(input => {
    input.removeAttribute("readonly");
    input.style.backgroundColor = "white";
  });
  //Habilitar el botón "Guardar" y deshabilitar "Editar datos"
  formU.querySelector("button[name='save']").disabled = false;
  editBtn.disabled = true;
});

//Botón "Eliminar usuario"
const deleteBtn = formU.querySelector("button[name='delete-user']");
deleteBtn.addEventListener("click", function() {
  //Confirmación antes de eliminar
  if (confirm("¿Seguro que deseas eliminar este usuario?")) {
    formU.submit();
  }
});

//Botón "Guardar" de usuario
const saveBtn = formU.querySelector("button[name='save']");
saveBtn.addEventListener("click", function(event) {
  //Validación
  const firstName = formU.querySelector("input[name='first-name']").value;
  const lastName = formU.querySelector("input[name='last-name']").value;
  const email = formU.querySelector("input[name='email']").value;
  const regex1 = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/;
  const regex2 = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/;
  if (!regex1.test(firstName.trim())) {
    alert("El nombre debe tener al menos 2 letras");
    event.preventDefault();
  } else if (!regex1.test(lastName.trim())) {
    alert("El apellido debe tener al menos 2 letras");
    event.preventDefault();
  } else if (!regex2.test(email.trim())) {
    alert("El formato del correo debe ser válido");
    event.preventDefault();
  }
});

//Botón "Añadir Usuario"
const form = document.querySelector("form[name='form']");
const addBtn = form.querySelector("button[name='add-user']");
if (addBtn) {
  addBtn.addEventListener("click", function(event) {
    const firstName = form.querySelector("input[name='first-name']").value;
    const lastName = form.querySelector("input[name='last-name']").value;
    const email = form.querySelector("input[name='email']").value;
    const password = form.querySelector("input[name='password']").value;
    const regex1 = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/;
    const regex2 = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/;
    const regex3 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
    //Validación
    if (!regex1.test(firstName.trim())) {
      alert("El nombre debe tener al menos 2 letras");
      event.preventDefault();
    } else if (!regex1.test(lastName.trim())) {
      alert("El apellido debe tener al menos 2 letras");
      event.preventDefault();
    } else if (!regex2.test(email.trim())) {
      alert("El formato del correo debe ser válido");
      event.preventDefault();
    } else if (!regex3.test(password.trim())) {
      alert("La contraseña debe tener al menos 8 caracteres, letras, números y un caracter especial");
      event.preventDefault();
    }
  });
}