/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});
function agregarProducto(id, token) {
    console.log("Inicio de la función agregarProducto");
    let url = "../cliente/accion/accionCarrito.php";
    let formData = new FormData();
    formData.append("id", id);
    formData.append("token", token);

    fetch(url, {
        method: "POST",
        body: formData,
        mode: "cors",
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Respuesta del servidor:", data);
            if (data.ok) {
                let carrito = document.getElementById("contadorCarrito");
                carrito.textContent = data.numero;

                console.log(data.numero);
            }
        })
        .catch((error) => {
            console.error("Error en la solicitud:", error);
        });
}

function actualizaCantidad(cantidad, id) {
    console.log("Inicio de la función actualizaCantidad");
    let url = "../cliente/accion/actualizarCarrito.php";
    let formData = new FormData();
    formData.append("action", "agregar");
    formData.append("id", id);
    formData.append("cantidad", cantidad);

    fetch(url, {
        method: "POST",
        body: formData,
        mode: "cors",
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.ok) {
            console.log("Respuesta del servidor:", data);

            // Verifica si el elemento existe antes de intentar acceder a él
            let divSubTotal = document.getElementById("subtotal_" + id);

            if (divSubTotal) {
                console.log("Contenido actual de divSubTotal:", divSubTotal.innerHTML);
                divSubTotal.innerHTML = data.sub;

                // Calcula el total sumando los subtotales de todos los productos
                let total = 0.00;
                let list = document.getElementsByName('subtotal[]');

                for (let i = 0; i < list.length; i++) {
                    total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
                }

                // Formatea el total antes de actualizar el elemento HTML
                total = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                }).format(total);

                document.getElementById('total').innerHTML = 'Total: $' + total;
            } else {
                console.error("Elemento no encontrado:", "subtotal_" + id);
            }
        }
    })
    .catch((error) => {
        console.error("Error en la solicitud:", error);
    });
}

/*document.addEventListener('DOMContentLoaded', function () {
    let eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina');
        buttonElimina.value = id;
    });
});
*/
function elimina() {
    console.log("Inicio de la función actualizaCantidad");

    let botonElimina = document.getElementById('btn-elimina')
    let id = botonElimina.value 

    let url = "../cliente/accion/actualizarCarrito.php";
    let formData = new FormData();
    formData.append("action", "eliminar");
    formData.append("id", id);

    fetch(url, {
        method: "POST",
        body: formData,
        mode: "cors",
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.ok) {
            let carrito = document.getElementById("contadorCarrito");
            carrito.textContent -= 1;
            location.reload()
        }
    })
    .catch((error) => {
        console.error("Error en la solicitud:", error);
    });
}


/*
const successModal = document.getElementById('successModal');
successModal.addEventListener('hidden.bs.modal', function () {
    // Redirigir al index.php después de cerrar el modal
    window.location.href = '../home/index.php';
});*/

document.addEventListener('DOMContentLoaded', function () {
    const successModal = document.getElementById('successModal');

    if (successModal) {
        successModal.addEventListener('hidden.bs.modal', function () {
            // Redirigir al index.php después de cerrar el modal
            window.location.href = '../home/index.php';
        });

        const comprarBtn = document.getElementById('comprarBtn');
        if (comprarBtn) {
            comprarBtn.addEventListener('click', function () {
                // Solo realiza la compra cuando se hace clic en el botón "Comprar"
                let url = "../cliente/accion/accionComprar.php";
                let formData = new FormData();
                formData.append("action", "comprar");

                fetch(url, {
                    method: "POST",
                    body: formData,
                    mode: "cors",
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Respuesta del servidor:", data);
                    if (data.ok) {
                        console.log(data);
                    }
                });
            });
        }

        console.log('Código adicional después de cerrar el modal...');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    let eliminaModal = document.getElementById('eliminaModal');
    if (eliminaModal) {
        eliminaModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina');
            buttonElimina.value = id;

            // Agregar un event listener para el clic en el botón de eliminación
            buttonElimina.addEventListener('click', function () {
                // Lógica para eliminar el producto del carrito
                eliminarProductoDelCarrito(id);

                // Cerrar el modal después de la eliminación
                let modal = bootstrap.Modal.getInstance(eliminaModal);
                modal.hide();
            });
        });
    }

    // Función para eliminar el producto del carrito (deberías adaptarla según tu lógica)
    function eliminarProductoDelCarrito(idProducto) {
        // Agrega aquí la lógica para eliminar el producto del carrito
        console.log('Eliminando producto del carrito con ID:', idProducto);
    }
});