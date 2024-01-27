import './bootstrap';
//llamamos el editor tinymce con las opciones requeridas
tinymce.init({
     // Seleccionamos el elemento (textarea) que va a ser controlado por TinyMCE
    selector: 'textarea#contenido',
    height: 300,
    plugins: 'lists link textcolor',
    /* Definimos las herramientas que vamos a utilizar
    funciones fontsize para ajustar el tamanio de texto
    aling__ para el ajuste del texto
    forecolor __ para darle color al texto*/
    toolbar: 'undo redo | bold italic | bullist numlist | link | forecolor | fontsizeselect | alignleft aligncenter alignright alignjustify',
    menubar: false
});