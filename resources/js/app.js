import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {

        // Esta función evita que se pierda la imagen en caso de 
        // no pasar la validación completa del formulario.
        if (document.querySelector('[name="imagen"]').value.trim())
        {
            const fileName = document.querySelector('[name="imagen"]').value.trim()
            const file = {name: fileName, size: 1234, url:`/uploads/${fileName}`};  
                
            let mockfile = {
                name: file.name,
                size: file.size,
            };
            
            // Función que mantiene guardado el archivo en el dropzone
            this.displayExistingFile(mockfile, file.url);
        }
    }
});

// Eventos

dropzone.on('success', function(file, response)
{
    // Asignando el nombre de la imagen devuelto por el controlador imagenes.store
    const imagenInput = document.querySelector('#imagen');
    imagenInput.value = response.imagen;
});

dropzone.on('removedfile', function () 
{
    // Borrando el id de la imagen del input del formulario 
    let imagenFile = document.querySelector("#name");
    imagenFile.value = "";
});


