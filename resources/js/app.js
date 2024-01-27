import './bootstrap';

tinymce.init({
    selector: 'textarea#contenido',
    height: 300,
    plugins: 'lists link textcolor',
    toolbar: 'undo redo | bold italic | bullist numlist | link | forecolor | fontsizeselect | alignleft aligncenter alignright alignjustify',
    menubar: false
});

document.addEventListener('DOMContentLoaded', function () {
    var alerta = document.getElementById('alert');
    if (alerta.innerText.trim() !== '') {
        alerta.classList.remove('hidden');
    }

    document.getElementById('closeBtn').addEventListener('click', function () {
        alerta.classList.add('hidden');
    });
});

function closeAlert() {
    var alerta = document.getElementById('alert');
    alerta.classList.add('hidden');
}