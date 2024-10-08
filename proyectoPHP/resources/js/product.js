const formP = document.querySelector("form[name='form-products']");

//Botón "Editar datos" de producto
const editBtn = formP.querySelector("button[name='edit']");
editBtn.addEventListener("click", function() {
    //Habilitar los campos para edición
    formP.querySelectorAll("input, textarea").forEach(input => {
        input.removeAttribute("readonly");
        input.style.backgroundColor = "white";
    });
    //Habilitar el botón "Guardar" y deshabilitar "Editar datos"
    formP.querySelector("button[name='save']").disabled = false;
    editBtn.disabled = true;
});

//Botón "Eliminar producto"
const deleteBtn = formP.querySelector("button[name='delete-product']");
deleteBtn.addEventListener("click", function() {
    //Aquí puedes añadir una confirmación antes de enviar el formulario
    if (confirm("¿Seguro que deseas eliminar este producto?")) {
        formP.submit();
    }
});

//Botón "Guardar" de producto
const saveBtn = formP.querySelector("button[name='save']");
saveBtn.addEventListener("click", function(event) {
    //Validación
    const name = formP.querySelector("input[name='name']").value;
    const description = formP.querySelector("textarea[name='description']").value;
    const price = formP.querySelector("input[name='price']").value;
    const image = formP.querySelector("input[name='image']").value;
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

//Botón "Añadir Producto"
const form = document.querySelector("form[name='form']");
const addBtn = form.querySelector("button[name='add-product']");
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