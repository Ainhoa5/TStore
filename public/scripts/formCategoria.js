/* En public/js/formCategoria.js */

/**
 * Agrega un evento de escucha al formulario de categoría para interceptar el envío.
 * Previene el comportamiento de envío predeterminado y envía los datos del formulario
 * a la API para crear una nueva categoría. Redirige a la página de gestión de categorías
 * en caso de éxito, o muestra un error en la consola si falla la solicitud.
 */
document.getElementById('category-form').addEventListener('submit', async function (event) {
    // Previene el envío tradicional del formulario para manejarlo con Fetch API.
    event.preventDefault();
    // Recopila los datos del formulario.
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    // Envía los datos del formulario a la API para crear una nueva categoría.
    try {
        const response = await fetch('/api/addCategoria', {
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
        console.log('Categoría añadida:', result);
    } catch (error) {
        // Captura y maneja errores, como problemas de red o respuestas fallidas de la API.
        console.error('Error al añadir la categoria:', error);
    }
});
