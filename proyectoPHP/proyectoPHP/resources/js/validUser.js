const form = document.querySelector("form[name='form']");

//Botón "Guardar" de usuario
const saveBtn = form.querySelector("button[name='update']");
saveBtn.addEventListener("click", function(event) {
  //Validación
  const firstName = form.querySelector("input[name='first-name']").value;
  const lastName = form.querySelector("input[name='last-name']").value;
  const email = form.querySelector("input[name='email']").value;
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