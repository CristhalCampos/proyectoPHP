const form = document.querySelector("form[name='form']");
let isValid = true;
function validatPassword() {
  const password = formP.querySelector("input[name='password']").value;
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
  if (!regex.test(password.trim())) {
    isValid = false;
  }
}
form.querySelector("button[name='new-password']").disabled = !isValid;
form.querySelector("input[name='password']").addEventListener('input', validatPassword);