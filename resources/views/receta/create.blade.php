@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" class="needs-validation" action="{{ route('receta.store') }}" novalidate>
        <div class="mb-3">
            <label for="InputRecetaTitle" class="form-label @error('title') is-invalid @enderror">{{ __('Title')}}</label>
            <input type="text" name="title" class="form-control" id="titleInput"  aria-describedby="titleHelp" required >
            <div id="titleHelp" class="form-text">{{ __('Try a nice title for you receta!. (max: 70 characters)') }}</div>

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputRecetaDescription" class="form-label @error('description') is-invalid @enderror">{{ __('Description')}}</label>
            <textarea type="text" name="description" class="form-control" id="descriptionInput" rows="3"style="resize: none" required ></textarea>
            <div id="descriptionHelp" class="form-text">{{ __('Why is a good receta?. (max: 255 characters)')}}</div>
        </div>
        <div class="mb-3">
            <label for="InputRecetaInstruction" class="form-label @error('instruction') is-invalid @enderror">{{ __('Instruction')}}</label>
            <textarea type="text" name="instruction" class="form-control" id="instructionInput" rows="3" style="resize: none" required ></textarea>
            <div id="instructionHelp" class="form-text">{{ __('Step by step?.')}}</div>
        </div>
        <div class="mb-3">
            <label for="InputRecetaIngredients" class="form-label @error('ingredients') is-invalid @enderror">{{ __('Ingredients')}}</label>
            <div id="ingredientsHelp" class="form-text">{{ __('Try a nice ingredients for you receta!. (max: 70 characters)') }}</div>
            <div id="ingredients-group" class="input-group">
                <input type="text" name="ingredients" class="form-control" id="ingredientsInput"  aria-describedby="ingredientsHelp" required >
                <button id="append-ingredient" class="btn btn-outline-secondary" type="button">Append</button>
                <button id="delete-ingredient" class="btn btn-outline-secondary" type="button">Delete</button>
            </div>

            @error('ingredients')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
