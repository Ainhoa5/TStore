/* En public/scripts/dashboardCategoria.js */
/**
 * Realiza una solicitud fetch para obtener todas las categorías desde la API y las muestra en la página.
 * @async
 * @function fetchCategories
 */
async function fetchCategories() {
    try {
        const response = await fetch('/api/categorias');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const categories = await response.json();
        updateCategoriesView(categories);
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

/**
 * Actualiza la vista del DOM para mostrar todas las categorías obtenidas de la API.
 * @param {Array} categories - Un array de objetos categoría para ser mostrados.
 */
function updateCategoriesView(categories) {
    const container = document.getElementById('categorias-container');
    container.innerHTML = ''; // Limpiar el contenido existente

    categories.forEach(category => { // Crea y configura elementos del DOM para cada categoría
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'product-container'; // Agregado para estilizar

        const categoryName = document.createElement('h3');
        const categoryDesc = document.createElement('p');
        const editButton = document.createElement('button');
        const deleteButton = document.createElement('button');
        const hiddenInput = document.createElement('input');

        categoryName.textContent = `Nombre: ${category.cat_nom}`;
        categoryDesc.textContent = `Observaciones: ${category.cat_obs}`;

        // Configuración del input oculto
        hiddenInput.type = 'hidden';
        hiddenInput.value = category.cat_id;
        hiddenInput.className = 'product-data'; // Clase para identificar el input oculto

        // Configurando botones
        editButton.textContent = 'Editar';
        deleteButton.textContent = 'Eliminar';
        editButton.className = 'button-link'; // Clase para estilizar e identificar
        deleteButton.className = 'button-link2'; // Clase para estilizar e identificar
        deleteButton.setAttribute('data-category-id', category.cat_id);
        editButton.setAttribute('data-category-id', category.cat_id);

        deleteButton.addEventListener('click', function () {
            const categoryId = this.getAttribute('data-category-id');
            deleteCategory(categoryId);
        });
        editButton.addEventListener('click', function () {
            const categoryId = this.getAttribute('data-category-id');
            fetchCategoryById(categoryId);
        });

        // Anexando elementos al categoryDiv
        categoryDiv.appendChild(categoryName);
        categoryDiv.appendChild(categoryDesc);
        categoryDiv.appendChild(hiddenInput);
        categoryDiv.appendChild(editButton);
        categoryDiv.appendChild(deleteButton);

        // Finalmente, anexando categoryDiv al contenedor
        container.appendChild(categoryDiv);
    });
}
/**
 * Elimina una categoría específica mediante una solicitud fetch a la API.
 * @async
 * @function deleteCategory
 * @param {string} categoryId - El ID de la categoría a eliminar.
 */
async function deleteCategory(categoryId) {
    try {
        const response = await fetch('/api/deleteCategoria', { // Realiza la solicitud fetch para eliminar la categoría
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ cat_id: categoryId })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log('Categoría eliminada:', result);
        window.location.reload();
    } catch (error) {
        console.error('Error al borrar la categoría:', error);
    }
}

/**
 * Obtiene los detalles de una categoría específica por su ID desde la API.
 * Para almacenarla en el localStorage y ser posteriormente utilizada para recoger los
 * datos de una categoria especifica y mostrarla en el formulario de actualización
 * @async
 * @function fetchCategoryById
 * @param {string} categoryId - El ID de la categoría cuyos detalles se quieren obtener.
 */
async function fetchCategoryById(categoryId) {
    try {
        const response = await fetch(`/api/getCategoriaById`, { // Realiza la solicitud fetch para obtener los detalles de la categoría
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ cat_id: categoryId })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const category = await response.json();
        localStorage.setItem('categoryData', JSON.stringify(category)); // almacenar localmente
        window.location.href = '/updateFormCategoria';

    } catch (error) {
        console.error('Error al obtener la categoría:', error);
    }
}

// Ejecuta `fetchCategories` cuando la página esté completamente cargada.
document.addEventListener('DOMContentLoaded', fetchCategories); // Cargar categorias cuando la página esté lista
