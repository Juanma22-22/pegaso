const tarjeta = document.querySelector('#tarjeta'),
       formulario = document.querySelector('#formulario-tarjeta'),
       numeroTarjeta = document.querySelector('#tarjeta .numero'),
       nombreTarjeta = document.querySelector('#tarjeta .nombre'),
       logoMarca = document.querySelector('#logoMarca'),
       firma = document.querySelector('#tarjeta .firma p'),
       mesExpiracion = document.querySelector('#tarjeta .mes'),
       yearExpiracion = document.querySelector('#tarjeta .year'),
       ccv = document.querySelector('#tarjeta .ccv');



//Volteamos la tarjeta para mostrar el frente
const mostrarFrente = () =>{
    if(tarjeta.classList.contains('active')){
        tarjeta.classList.remove('active');
    }
}


// * Rotacion de la tarjeta
tarjeta.addEventListener('click',() =>{
    tarjeta.classList.toggle('active');
});



// * Select del mes generado dinamicamente
for (let i = 1; i <= 12; i++) {
    let opcion = document.createElement('option');
    opcion.value = i;
    opcion.innerText = i;
    formulario.selectMes.appendChild(opcion);
}

// * select del año generado dinamicamente
const yearActual = new Date().getFullYear();
for (let i = yearActual; i <= yearActual + 8; i++) {
    let opcion = document.createElement('option');
    opcion.value = i;
    opcion.innerText = i;
    formulario.selectYear.appendChild(opcion);
}

// * Numero de tarjeta
formulario.inputNumero.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    formulario.inputNumero.value = valorInput
    //eliminamos espacios en blanco
    .replace(/\s/g,'')
    //eliminarlas letras
    .replace(/\D/g,'')
    //Poner espacios cada 4 numeros
    .replace(/([0-9]{4})/g,'$1 ')
    //eliminar el ultimo espacio
    .trim();

    numeroTarjeta.textContent = valorInput;


    if(valorInput == ''){
        numeroTarjeta.textContent = '#### #### #### ####';

        logoMarca.innerHTML = '';
    }

    if (valorInput[0] == 4) {
        logoMarca.innerHTML = '';
        const imagen = document.createElement('img');
        imagen.src = '/img/logos/visa.png'

        logoMarca.appendChild(imagen);
    }else if (valorInput[0] == 5) {
        logoMarca.innerHTML = '';
        const imagen = document.createElement('img');
        imagen.src = '/img/logos/mastercard.png'

        logoMarca.appendChild(imagen);
    }
    //Funcion que voltea la tarjeta para ver el frente
    mostrarFrente();
});


//Input nombre Tarjeta
formulario.inputNombre.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    formulario.inputNombre.value = valorInput.replace(/[0-9]/g, '');
    nombreTarjeta.textContent = valorInput;
    firma.textContent = valorInput;

    if(valorInput == ''){
        nombreTarjeta.textContent = 'Jhon Doe';
        firma.textContent = 'Jhon Doe';
    }
    mostrarFrente();
});


//  Select del mes

formulario.selectMes.addEventListener('change',(e) => {
    mesExpiracion.textContent = e.target.value;
    mostrarFrente();
});

// Select para poner el año
formulario.selectYear.addEventListener('change',(e) => {
    yearExpiracion.textContent = e.target.value.slice(2);
    mostrarFrente();
})

//Ccv

formulario.inputCCV.addEventListener('keyup', (e) => {
    if (!tarjeta.classList.contains('active')) {
        tarjeta.classList.toggle('active');
    }

    formulario.inputCCV.value = formulario.inputCCV.value
    //Elimnar los espacios
    .replace(/\s/g,'')
    //Eliminarlas letras
    .replace(/\D/g,'');

    ccv.textContent = formulario.inputCCV.value;
});

