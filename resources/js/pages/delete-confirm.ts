import Swal from 'sweetalert2'; 

document.addEventListener('DOMContentLoaded', function () {
    // Specify the correct type for the elements being selected.
    document.querySelectorAll<HTMLButtonElement>('.btn-delete').forEach(btn => {
        
        // Use an arrow function to avoid complex 'this' typing, 
        // or rely on 'event.currentTarget' which is cleaner in general.
        btn.addEventListener('click', function(event) {
            // event.currentTarget will be the button that was clicked.
            const button = event.currentTarget as HTMLButtonElement; 
            const id = button.getAttribute('data-id');
            const text = button.getAttribute('data-text') || '';

            Swal.fire({
                title: '¿Estás seguro?',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed && id) {
                    const form = document.getElementById('delete-form-' + id);
                    // Assert the type before calling .submit()
                    if (form) (form as HTMLFormElement).submit();
                }
            });
        });
    });
});