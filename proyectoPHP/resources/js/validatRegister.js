let isValid = true;
function validatFirstName() {
  let firstName = document.forms["form"]["first-name"].value;
  let regex1 = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/;
  if (!regex1.test(firstName.trim())) {
    document.getElementById('valid1').textContent = '❌';
    isValid = false;
  } else {
    document.getElementById('valid1').textContent = '✔';
  }
}
function validatLastName() {
  let lastName = document.forms["form"]["last-name"].value;
  let regex1 = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/;
  if (!regex1.test(lastName.trim())) {
    document.getElementById('valid2').textContent = '❌';
    isValid = false;
  } else {
    document.getElementById('valid2').textContent = '✔';
  }
}
function validatEmail() {
  let email = document.forms["form"]["email"].value;
  let regex2 = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/;
  if (!regex2.test(email.trim())) {
    document.getElementById('valid3').textContent = '❌';
    isValid = false;
  } else {
    document.getElementById('valid3').textContent = '✔';
  }
}
function validatPassword() {
  let password = document.forms["form"]["password"].value;
  let regex3 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
  if (!regex3.test(password.trim())) {
    document.getElementById('valid4').textContent = '❌';
    isValid = false;
  } else {
    document.getElementById('valid4').textContent = '✔';
  }
}
document.getElementById('div-register').addEventListener('mouseover', () => {document.getElementById('response').textContent = isValid ? "" : 'Por favor llena todos los campos'});
document.getElementById("register").disabled = !isValid;
document.forms["form"]["first-name"].addEventListener('input', validatFirstName);
document.forms["form"]["last-name"].addEventListener('input', validatLastName);
document.forms["form"]["email"].addEventListener('input', validatEmail);
document.forms["form"]["password"].addEventListener('input', validatPassword);