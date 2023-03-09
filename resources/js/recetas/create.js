$(function() {
  const deleteIngredientElementsKey = '.delete-ingredient';
  const containerElement = $('#ingredients');
  const addIngredientElement = $("#add-ingredient");
  const emptyMessage = '<p class="text-danger">Lista de ingredientes vacía.</p>';

  function add(item = null) {
    if (isEmpty()) {
      clearContainer();
    }

    const id = Date.now();

    containerElement.append(
      `<div id="ingredient-group-${id}" class="input-group mb-3">
        <input
            id="ingredient-input-${id}"
            type="text"
            class="form-control"
            name="ingredients[]"
            aria-describedby="ingredientHelp"
            value="${item || ''}"
            required
        >
        <button
          class="delete-ingredient btn btn-outline-secondary"
          type="button"
        >
          Delete
        </button>
      </div>`
    );

    if (isAtMaxCapacity()) {
      toggleAddIngredientButton();

      return;
    }
  }

  function clearContainer() {
    containerElement.first().html('');
  }

  function deleteIngredient(event) {
    event.target.parentElement.remove();

    if (!isAtMaxCapacity()) {
      toggleAddIngredientButton();
    }

    if (isEmpty()) {
      showEmptyMessage();
    }
  }

  function toggleAddIngredientButton() {
    addIngredientElement.prop(
      'disabled',
      !addIngredientElement.prop('disabled')
    );
  }

  function ingredientsLength() {
    return $(deleteIngredientElementsKey).length;
  }

  function init() {
    recoverOldIngredients();
    addIngredientElement.on('click', function () { add(); });
    containerElement.on('click', deleteIngredientElementsKey, deleteIngredient);
  }

  function isAtMaxCapacity() {
    return ingredientsLength() >= Number(import.meta.env.VITE_MAX_INGREDIENTS_PER_RECETA);
  }

  function isEmpty() {
    return ingredientsLength() < 1;
  }

  function recoverOldIngredients() {
    if (!oldIngredients || oldIngredients.length < 1) {
      showEmptyMessage();

      return;
    }

    oldIngredients.forEach((item) => add(item));
  }

  function showEmptyMessage() {
    containerElement.first().html(emptyMessage);
  }
  
  init();
});
