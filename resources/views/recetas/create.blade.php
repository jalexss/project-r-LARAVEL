@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" class="needs-validation" action="{{ route('recetas.store') }}" novalidate>
        @csrf

        <div class="row mb-3">
            <label for="title" class="form-label">{{ __('Title')}}</label>
            <div id="titleHelp" class="col-md-6 form-text">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="titleInput" value="{{ old('title') }}" required autofocus>
                {{ __('Try a nice title for you receta!. (max: 70 characters)') }}

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description')}}</label>
            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="descriptionInput" rows="3"style="resize: none" required ></textarea>
            <div id="descriptionHelp" class="form-text">{{ __('Why is a good receta?. (max: 255 characters)')}}</div>
            
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="instruction" class="form-label">{{ __('Instruction')}}</label>
            <textarea type="text" name="instruction" class="form-control @error('instruction') is-invalid @enderror" id="instructionInput" rows="3" style="resize: none" required ></textarea>
            <div id="instructionHelp" class="form-text">{{ __('Step by step?.')}}</div>
            
            @error('instruction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="minutes" class="form-label">{{ __('Minutes')}}</label>
            <input type="number" name="minutes" class="form-control @error('minutes') is-invalid @enderror" id="minutesInput" required >
            <div id="minutesHelp" class="form-text">{{ __('(Max 4000 minutes!)')}}</div>
        
            @error('minutes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div id="ingredients-container" class="mb-3">
            <label for="InputRecetaIngredients" class="form-label @error('ingredients') is-invalid @enderror">{{ __('Ingredients')}}</label>
            <div
                id="ingredientsHelp"
                class="form-text"
            >
                Try a nice ingredients for you receta!. (max: 70 characters)
            </div>

            <div id="ingredients"></div>
            
            @error('ingredients')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button id="add-ingredient" class="btn btn-outline-secondary" type="button">Add</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
@once
    @push('scripts')
        <script>var oldIngredients = {{ Js::from(old('ingredients')) }}</script>
        @vite(['resources/js/recetas/create.js'])
        <script type="module">
            // $(document).ready(function(){
            //     console.log('jquery-actived');
            //     $("#add-ingredient").click(function () {
            //         console.log('add input')
            //         var newInput = $('#ingredients-group:first').clone();
            //         newInput.find('#ingredientsInput').val('');
            //         $('for-ingredients').append(newInput);
            //     });

            //     $("#for-ingredients").on('click', '.remove-input', function() {
            //         $(this).closest('#ingredients-group').remove();
            //     })
                //         '<button id="delete-ingredient" class="btn btn-outline-secondary" type="button">Delete</button>';
                //     $("#ingredients").append(newInput);

                //     if($("#ingredients").find('input').length < 10)
                //         $('#ingredients').append(newInput);
                //     else{
                //         $("#add-ingredient").attr("disabled", "true");
                //     }
                // //     console.log('add-ingredient-input')
                // //     var newInput = '<input type="text" name="ingredients" class="form-control" id="ingredientsInput"  aria-describedby="ingredientsHelp" required >' +
                // //         '<button id="delete-ingredient" class="btn btn-outline-secondary" type="button">Delete</button>';
                // //    $("#ingredients").append(newInput);
                // });
        
                // $("#for-ingredients").on("click", "#delete-ingredient", function () {
                //     $(this).parents("#ingredients").remove();
                // });
            
            // });
        </script>
    @endpush
@endonce
