@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Tiendas')
@endcomponent

<div class="container">
	<div class="row">
		
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<h6>Búsqueda:</h6>
				</div>
				<div class="col">
					<form action="#" id="nombre-buscar">
						<input type="text" placeholder="Nombre" class="form-control">
					</form>
				</div>
				<div class="col">
					<select name="tipo" class="form-control" id="">
						<option value="">Tipo de Negocio</option>
						@foreach(App\Clase::clases() as $clase)
						<option value="{{ $clase->slug }}">{{ title_case($clase->nombre) }}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<select name="ciudad" class="form-control" id="">
						<option value="">Ciudad</option>
						@foreach(App\Ciudad::ciudades() as $ciudad)
						<option value="{{ $ciudad->slug }}">{{ title_case($ciudad->nombre) }}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<select name="tipo" class="form-control" id="">
						<option value="">Comuna</option>
						@foreach(App\Comuna::comunas() as $comuna)
						<option value="{{ $comuna->slug }}">{{ title_case($comuna->nombre) }}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				
			@foreach($tiendas as $tienda)
				<div class="col-md-3 m-0 p-0 p-md-1">
					<a href="{{ route('ver.tienda' , [$tienda->slug]) }}">
					
					@if($tienda->foto_local == null )
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
					@else
					<div class="fondo-foto" style="background-image: url('{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->foto_local ) }}');">
					@endif
						<div class="fondo">
							<h3>{{ $tienda->nombre }}</h3>
							<p>{{ str_limit($tienda->descripcion , 300) }}</p>
						</div>
					</div>
					</a>
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
		$('#nombre-buscar').on('submit' , function(e){
			e.preventDefault();
		})
	});
</script>
@endsection