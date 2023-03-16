@foreach ($recetas as $receta)
    <div class="col">
          <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $receta->title }}</h5>
                <p class="card-text">{{ $receta->description }}</p>
                <a class="link-secondary" href="{{ route('recetas.show', $receta->id) }}">{{ __('See More...') }}</a>
            </div>
        </div>
        
    </div>
@endforeach
                