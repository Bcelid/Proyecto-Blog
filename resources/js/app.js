import './bootstrap';

tinymce.init({
    selector: 'textarea#contenido',
    height: 300,
    plugins: 'lists link textcolor',
    toolbar: 'undo redo | bold italic | bullist numlist | link | forecolor | fontsizeselect | alignleft aligncenter alignright alignjustify',
    menubar: false
});