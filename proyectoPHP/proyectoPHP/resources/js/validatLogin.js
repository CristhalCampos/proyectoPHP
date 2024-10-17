let isValid = true;
function validatEmail() {
  let email = document.forms["form"]["email"].value;
  let regex1 = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/;
  if (!regex1.test(email.trim())) {
    document.getElementById('valid1').textContent = '❌'
    isValid = false
  } else {
    document.getElementById('valid1').textContent = '✔'
  }
}
function validatPassword() {
  let password = document.forms["form"]["password"].value;
  let regex2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
  let isValid = true;
  if (!regex2.test(password.trim())) {
    document.getElementById('valid2').textContent = '❌'
    isValid = false
  } else {
    document.getElementById('valid2').textContent = '✔'
  }
}
document.getElementById('div-login').addEventListener('mouseover', () => {document.getElementById('response').textContent = isValid ? "" : 'Por favor llena todos los campos'});
document.getElementById("login").disabled = !isValid;
document.forms["form"]["email"].addEventListener('input', validatEmail);
document.forms["form"]["password"].addEventListener('input', validatPassword);
