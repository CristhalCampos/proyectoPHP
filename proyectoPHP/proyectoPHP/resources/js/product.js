//Botón "Añadir Producto"
const form = document.querySelector("form[name='form']");
const addBtn = form.querySelector("button[name='add']");
if (addBtn) {
    addBtn.addEventListener("click", function(event) {
        const name = form.querySelector("input[name='name']").value;
        const description = form.querySelector("textarea[name='description']").value;
        const price = form.querySelector("input[name='price']").value;
        const image = form.querySelector("input[name='image']").value;
        //Validación
        if (name.trim().length < 2) {
            alert("El nombre del producto debe tener al menos 2 caracteres.");
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
}