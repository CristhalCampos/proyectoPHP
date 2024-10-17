const form = document.querySelector("form[name='form']");
let isValid = true;
function validatEmail() {
  const email = formE.querySelector("input[name='email']").value;
  const regex = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/;
  if (!regex.test(email.trim())) {
    isValid = false;
  }
}
form.querySelector("button[name='reset']").disabled = !isValid;
form.querySelector("input[name='email']").addEventListener('input', validatEmail);