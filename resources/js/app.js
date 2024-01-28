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
document.addEventListener('DOMContentLoaded', function() {
    // Configuración de alerta para nuevo post
    var successAlert_newPost = document.getElementById('successAlert_newPost');
    var errorAlert_newPost = document.getElementById('errorAlert_newPost');
    if (successAlert_newPost) {
        setTimeout(function() {
            successAlert_newPost.style.opacity = '0';
        }, 3000);
        successAlert_newPost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
    if (errorAlert_newPost) {
        setTimeout(function() {
            errorAlert_newPost.style.opacity = '0';
        }, 3000);
        errorAlert_newPost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
    // Configuración de alerta para editar post
    var successAlert_editPost = document.getElementById('successAlert_editPost');
    var errorAlert_editPost = document.getElementById('errorAlert_editPost');
    if (successAlert_editPost) {
        setTimeout(function() {
            successAlert_editPost.style.opacity = '0';
        }, 3000);
        successAlert_editPost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
    if (errorAlert_editPost) {
        setTimeout(function() {
            errorAlert_editPost.style.opacity = '0';
        }, 3000);
        errorAlert_editPost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
    // Configuración de alerta para elimimar post
    var successAlert_deletePost = document.getElementById('successAlert_deletePost');
    var errorAlert_deletePost = document.getElementById('errorAlert_deletePost');
    if (successAlert_deletePost) {
        setTimeout(function() {
            successAlert_deletePost.style.opacity = '0';
        }, 3000);
        successAlert_deletePost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
    if (errorAlert_deletePost) {
        setTimeout(function() {
            errorAlert_deletePost.style.opacity = '0';
        }, 3000);
        errorAlert_deletePost.addEventListener('click', function() {
            this.style.opacity = '0';
        });
    }
});