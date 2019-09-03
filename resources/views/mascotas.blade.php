@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mascotas')
@endcomponent

<div class="text-white bg-primary text-right p-2 rounded-right busqueda-toggle" id="btn-filtro">
					<i class="fa fa-filter"></i>
			</div>
			
<div class="container">
	<div class="row">

		<div class="col-md-2 pt-4 pb-4 mt-4 mb-0" id="filtros-buscar">

			
			
			<div class="row">
				<div class="col">
					<h6 class="text-center color-primary"><strong>Búsqueda</strong></h6>
					<hr class="color-primary">
				<form action="{{ route('buscar.mascota.nombre') }}" class="form-buscar">
					<input type="text" placeholder="Nombre" class="form-control bg-primary text-white mb-3" value="{{ isset($_GET['nombre']) ? $_GET['nombre'] : '' }}" name="nombre">

					

					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
				
				

				</div>
			</div>

			
			
		</div>
		
		<div class="col pt-4 pb-4 mt-4 mb-4">

			
			
			<div class="row">

				@if($mascotas->count() == 0)
					<div class="col text-center">

						<h2>No se encontraron productos!</h2>
						<img src="{{ asset('images/paw.png') }}" style="max-width: 300px" alt="">
					</div>
				@endif
				
				
				 @foreach($mascotas as $mascota)
            <div class="col-md-3 mb-4">
             
              <div class="fondo-foto"
              @if($mascota->foto == null)
              style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
              @else 
              style="background-image: url('{{ asset( 'storage/archivos/'. $mascota->user->id . '/' . $mascota->foto ) }}');"
              @endif
              >
            
              <div class="fondo">
                <h6 class="border-bottom">{{ title_case($mascota->nombre) }}</h6>
                <p>{{ str_limit( $mascota->descripcion , 200) }}</p>
                <p><a 
                  @if($mascota->foto == null)
                  href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
                  @else
                  href="{{ asset( 'storage/archivos/'. $mascota->hogar->user->id . '/' . $mascota->foto ) }}"
                  @endif 
                  rel="lightbox">Ampliar imagen</a></p>
                <p><a href="{{ route('ver.hogar' , [$mascota->hogar->slug]) }}">Visitar hogar</a></p>
                  

              </div>
            </div>

            </div>
          @endforeach

			</div>

		</div>


	</div>
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$('.form-buscar').change(function(){
			$(this).submit();
		});
	});
</script>
@endsection