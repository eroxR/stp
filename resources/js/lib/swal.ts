import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

// 1. Crea un "mixin". Es una instancia de Swal con configuraciones por defecto.
const ThemedSwal = Swal.mixin({
    // 2. Aquí aplicamos nuestra clase de tema a los elementos principales del modal.
    customClass: {
        popup: 'swal-theme', // Aplica nuestra clase principal al contenedor del modal
        confirmButton: 'swal2-confirm', // No necesita estilos directos, pero lo nombramos por consistencia
        cancelButton: 'swal2-cancel',
        validationMessage: 'swal2-validation-message',
    },
    // 3. Le decimos a Swal que los botones deben usar las clases que definimos, no las suyas.
    buttonsStyling: false,
});

// 4. (Opcional, pero consistente con tu código) Envuelve la instancia themada con ReactContent.
export const MySwal = withReactContent(ThemedSwal);