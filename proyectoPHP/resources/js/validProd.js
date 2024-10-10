const form = document.querySelector("form[name='form']");

//Botón "Guardar" de producto
const saveBtn = form.querySelector("button[name='update']");
saveBtn.addEventListener("click", function(event) {
    //Validación
    const name = form.querySelector("input[name='name']").value;
    const description = form.querySelector("textarea[name='description']").value;
    const price = form.querySelector("input[name='price']").value;
    const image = form.querySelector("input[name='image']").value;
    if (name.trim().length < 2) {
        alert("Nombre del producto debe tener al menos 2 caracteres.");
        event.preventDefault();
    } else if (description.trim().length < 5) {
        alert("La descripción debe tener al menos 5 caracteres.");
        event.preventDefault();
    } else if (isNaN(price) || price <= 0) {
        alert("El precio debe ser un número válido.");
        event.preventDefault();
    } else if (!image.trim()) {
        alert("Debe ingresar una URL de la imagen.");
        event.preventDefault();
    }
});