@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a type="button" class="btn btn-primary" href='{{ route('recetas.create') }}' >Create Receta</a>
            <div id="receta-container" class="row row-cols-1 row-cols-md-2 g-4"></div>

            <div id="loading-spinner-container" class="d-flex justify-content-center">
                <div id="loading-spinner" class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection
@once
    @push('scripts')
        <script>var recetasUrl = {{ Js::from(route('getRecetas')) }}</script>
        @vite(['resources/js/home/home.js'])
    @endpush
@endonce