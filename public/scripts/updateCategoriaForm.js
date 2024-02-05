/* En public/js/updateCategoriaForm.js */

/**
 * Maneja el evento de envío del formulario de edición de categoría.
 * Intercepta el envío predeterminado para realizar una solicitud fetch a la API,
 * permitiendo la actualización de una categoría específica. En caso de éxito,
 * redirige al usuario a la página de gestión de categorías. Muestra errores en la consola
 * si la solicitud falla.
 */
document.getElementById('edit-categoria-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Previene el envío tradicional del formulario.

    // Recopila los datos del formulario.
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());

    try {
        // Envía la solicitud a la API para actualizar la categoría.
        const response = await fetch('/api/updateCategoria', {
            method: 'POST', // Método HTTP utilizado para la solicitud.
            headers: {
                'Content-Type': 'application/json', // Indica que el cuerpo de la solicitud está en formato JSON.
            },
            body: JSON.stringify(data) // Convierte los datos del formulario a una cadena JSON.
        });

        // Verifica si la respuesta de la solicitud no es exitosa.
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        } else {
            // Redirige al usuario a la página de gestión de categorías después de un éxito.
            window.location.href = '/admin/dashboard/categorias';
        }

        // Opcional: Manejo de la respuesta para lógica adicional.
        const result = await response.json();
        console.log('Categoría actualizada:', result);
        // Aquí puedes agregar lógica adicional, como actualizar la vista o mostrar un mensaje de éxito.
    } catch (error) {
        // Captura y maneja errores, como problemas de red o respuestas fallidas de la API.
        console.error('Error al actualizar la categoría:', error);
    }
});