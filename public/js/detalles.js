function changeButtonColor(button) {
    var buttons = document.querySelectorAll('.btn-group button');
    
    // Reinicia todos los botones a su estado original
    buttons.forEach(function (btn) {
        btn.classList.remove('active');
        btn.classList.add('btn-secondary');
    });

    // Establece el botón clicado como activo y de color azul
    button.classList.remove('btn-secondary');
    button.classList.add('active', 'btn-primary');
}


function changeButtonColor(button) {
    var buttons = document.querySelectorAll('.btn-group button');
    var datosUsuario = document.getElementById('datos-usuario');
    var holaMundo = document.getElementById('hola-mundo');

    // Reinicia todos los botones a su estado original
    buttons.forEach(function (btn) {
        btn.classList.remove('active');
        btn.classList.add('btn-secondary');
    });

    // Establece el botón clicado como activo y de color azul
    button.classList.remove('btn-secondary');
    button.classList.add('active', 'btn-primary');

    // Muestra u oculta los elementos según el botón clicado
    if (button.getAttribute('data-target') === '#home') {
        datosUsuario.style.display = 'block';
        holaMundo.style.display = 'none';
    } else if (button.getAttribute('data-target') === '#profile') {
        datosUsuario.style.display = 'none';
        holaMundo.style.display = 'block';
    }
}

