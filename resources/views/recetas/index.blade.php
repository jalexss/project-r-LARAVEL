@extends('layouts.app')
@section('content')
<div class="container">
    <a class="btn btn-primary" href="{{ route('recetas.create') }}">Create Receta</a>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">{{ __('id') }}</th>
            <th scope="col">{{ __('profile id') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Minutes') }}</th>
            <th scope="col">{{ __('CreatedAt') }}</th>
            <th scope="col">{{ __('UpdatedAt') }}</th>
            <th scope="col" width="280px">{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($recetas as $receta)
            <tr>
                <th scope="row">{{ $receta->id }}</th>
                <td>{{ $receta->profile_id }}</td>
                <td>{{ $receta->title }}</td>
                <td>{{ $receta->minutes }}</td>
                <td>{{ $receta->created_at }}</td>
                <td>{{ $receta->updated_at }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('recetas.show', $receta->id) }}">{{ __('Show') }}</a>
        
                    <a class="btn btn-primary" href="{{ route('recetas.edit',$receta->id) }}">{{ __('Edit') }}</a>
   
                    <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
          
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>    
    </table> 
</div>
@endsection