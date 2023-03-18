@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        <h1>Show</h1>
        @if(  auth()->user()->id === $receta->profile->user_id )
            <a class="btn btn-primary" href="{{ route('recetas.edit',$receta->id) }}">{{ __('Edit') }}</a>
        @endif

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

        <div class="container text-center">
            <div class="row row-cols-3">
                @foreach ($receta->images as $image)
                <div class="col">
                    <img 
                        class="img-fluid" 
                        src="{{ asset('/storage/users/'. $receta->profile->user_id . '/recetas/' . $receta->id . "/" . $image->name )}}" 
                    />
                </div>
                @endforeach
            </div>
        </div>

        <p>Comentarios soon...</p>
    </div>
</div>
@endsection