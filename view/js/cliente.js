// vistaCliente.js

document.addEventListener("DOMContentLoaded", () => {
    const botonesCarrito = document.querySelectorAll(".btn-carrito");
    const botonesDetalle = document.querySelectorAll(".btn-detalle");

    botonesCarrito.forEach(boton => {
        boton.addEventListener("click", () => {
            alert("🛒 Producto agregado al carrito");
        });
    });

    botonesDetalle.forEach(boton => {
        boton.addEventListener("click", () => {
            alert("🔍 Mostrando detalles del producto...");
        });
    });
});
