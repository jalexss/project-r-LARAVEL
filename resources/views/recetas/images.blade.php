@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" class="needs-validation" action="{{ route('recetas') }}" novalidate>
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
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
@once
    @push('scripts')
        <script type="module">
        </script>
    @endpush
@endonce