@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        <h1>Show</h1>
        <h3>{{ __('title') }}</h3>
        <p>{{ $receta->title }}</p>

        <h3>{{ __('description') }}</h3>
        <p>{{ $receta->description }}</p>

        <h3>{{ __('instruction') }}</h3>
        <p>{{ $receta->instruction }}</p>

        <h3>{{ __('minutes') }}</h3>
        <p>{{ $receta->minutes }}</p>

        <h3>{{ __('created At') }}</h3>
        <p>{{ $receta->created_at }}</p>

        <h3>{{ __('updated At') }}</h3>
        <p>{{ $receta->updated_at }}</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ingredient') }}</th>
                    <th scope="col">{{ __('description') }}</th>
                </tr>
                </thead>
            <tbody>
                @foreach ($receta->ingredients as  $ingredient)
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $ingredient->description}}</td>
                @endforeach
            </tbody>
        </table>

        <p>Comentarios e imagenes soon...</p>
    </div>
</div>
@endsection