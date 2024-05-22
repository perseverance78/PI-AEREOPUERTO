// Obtener los elementos modales
var insertModal = document.getElementById('insert-modal');
var editModal = document.getElementById('edit-modal');

// Obtener los botones de apertura de modales
var insertBtn = document.getElementById('insert-btn');
var editBtns = document.querySelectorAll('.edit-btn');

// Obtener el elemento span para cerrar los modales
var closeBtns = document.querySelectorAll('.close');

// Función para abrir el modal de inserción
function openInsertModal() {
  insertModal.style.display = 'block';
}

// Función para abrir el modal de edición
function openEditModal() {
  editModal.style.display = 'block';
}

// Función para cerrar todos los modales
function closeModal() {
  insertModal.style.display = 'none';
  editModal.style.display = 'none';
}

// Event listener para el botón de inserción
insertBtn.addEventListener('click', openInsertModal);

// Event listener para cada botón de edición
editBtns.forEach(function(btn) {
  btn.addEventListener('click', openEditModal);
});

// Event listener para cada botón de cierre
closeBtns.forEach(function(btn) {
  btn.addEventListener('click', closeModal);
});
