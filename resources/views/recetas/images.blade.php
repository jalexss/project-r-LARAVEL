@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" class="needs-validation" action="{{ route('recetas.updateImages', $receta->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label @error('images') is-invalid @enderror" >Multiple files input example</label>
            <input 
                class="form-control" 
                type="file" 
                id="formFileMultiple" 
                multiple
                name="images[]"
            >
            @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if (count($errors) > 0)
                <div >

                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
@once
    @push('scripts')
        <script type="module">
        </script>
    @endpush
@endonce