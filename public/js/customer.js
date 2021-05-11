const carrito = new Array();
var i = 0;
var a = 0;


function cambiarPrecio(codigo) {
    const precioUnidad = document.querySelector('#precio' + codigo),
        precioTotal = document.querySelector('#precioTotal' + codigo),
        cantidad = document.querySelector('#cantidad' + codigo);

    cantidad.addEventListener('change', (e) => {
        let valorInput = e.target.value;
        precioTotal.value = precioUnidad.value * valorInput;
    });

}

/*
function agregarCarrito(codigo) {
    var precioUnidad = document.querySelector('#precio' + codigo).value,
        precioTotal = document.querySelector('#precioTotal' + codigo).value,
        cantidad = document.querySelector('#cantidad' + codigo).value,
        nombre = document.querySelector('#nombreProducto' + codigo).value;
    var comprobar = false;

    if (carrito.length == 0) {
        var producto = new Array();

        producto["codigo"] = codigo;
        producto["nombre"] = nombre;
        producto["cantidad"] = cantidad;
        producto["precioUnidad"] = precioUnidad;
        producto["precioTotal"] = precioTotal;

        carrito.push(producto);

    } else {

        carrito.forEach(element => {
            if (element.codigo === codigo) {
                cantidad = parseInt(cantidad);
                cantidad += parseInt(element.cantidad);
                comprobar = true;

            } else if (comprobar == false) {
                for (let posicion = 0; posicion < sessionStorage.length; posicion++) {
                    var prueba = sessionStorage.getItem(posicion.toString());
                    prueba = JSON.parse(prueba);
                    if (prueba.codigo == codigo) {
                        a = posicion;
                        break;
                    }
                }

                var producto = new Array();

                producto["codigo"] = codigo;
                producto["nombre"] = nombre;
                producto["cantidad"] = cantidad;
                producto["precioUnidad"] = precioUnidad;
                producto["precioTotal"] = precioTotal;

                carrito.push(producto);
            }

        });

    }
    //console.log(comprobar);
    if (comprobar == true) {
        var product = { codigo: codigo, nombre: nombre, cantidad: cantidad, precioUnidad: precioUnidad, precioTotal: precioTotal };
        sessionStorage.setItem(a.toString(), JSON.stringify(product));
        i++;
    } else {
        var product = { codigo: codigo, nombre: nombre, cantidad: cantidad, precioUnidad: precioUnidad, precioTotal: precioTotal };
        sessionStorage.setItem(i.toString(), JSON.stringify(product));
        i++;
    }



}

function verCarrito() {
    console.log(sessionStorage);
    for (let i = 0; i < sessionStorage.length; i++) {
    console.log(sessionStorage.getItem(i.toString()));
    }
}

*/
