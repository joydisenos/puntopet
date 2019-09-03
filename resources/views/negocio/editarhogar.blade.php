@extends('master.front')

@section('header')
<style>
	#map{
		height: 300px;
		width: 100%;
		margin-bottom: 30px;
		overflow: hidden;
	}
</style>
@endsection

@section('content')

@component('components.header')
    @slot('titulo' , 'Editar Hogar ' . title_case($hogar->nombre))
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="tabs" id="hogares">

			 <ul class="nav nav-tabs card-header-tabs mb-4">
                  <li class="nav-item">
                    <a class="pestana nav-link active" data-target=".datos" href="#">Datos</a>
                  </li>
                  <li class="nav-item">
                    <a class="pestana nav-link" data-target=".fotos" href="#">Fotos</a>
                  </li>
                </ul>

			<div class="tab datos">
				<form action="{{ route('hogar.actualizar' , [$hogar->id]) }}" method="post" enctype="multipart/form-data">
					@csrf

					@component('components.hogares')
					@slot('hogar' , $hogar)
					@endcomponent

					<div class="row mb-4">
						<div class="col">
							<button class="btn btn-primary" type="submit">
								Actualizar
							</button>
						</div>
					</div>

				</form>
			</div>

			<div class="tab fotos ocultar">

				<div class="row mb-4">
					<div class="col text-center">
						<h4>Agregar foto</h4>
					</div>
				</div>

				<form action="{{ route('negocio.subir.fotos') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="hogar_id" value="{{ $hogar->id }}">
					@csrf
					<div class="row mb-4">
						<div class="col">
							<input type="text" name="nombre" class="form-control" placeholder="Nombre">
						</div>
						<div class="col">
							<input type="file" name="foto">
						</div>
						<div class="col">
							<button type="submit" class="btn btn-primary"><i class="fa fa-upload mr-2"></i>Subir</button>
						</div>
					</div>
				</form>

				@if($hogar->fotos->count() > 0)
				<div class="row mb-4">
					<div class="col text-center">
						<h4>Fotos registradas</h4>
					</div>
				</div>
				@endif

				<div class="row">
					@foreach($hogar->fotos as $foto)
					<div class="col-md-4 mb-4">
						
							
							<div class="fondo-foto" style="background-image: url('{{ asset( 'storage/archivos/'. Auth::user()->id . '/' . $foto->archivo ) }}');">
							
								<div class="fondo">
									<p class="border-bottom">{{ $foto->nombre }}</p>
									<p><a href="{{ asset( 'storage/archivos/'. Auth::user()->id . '/' . $foto->archivo ) }}" rel="lightbox">ver foto</a></p>
									<p>Subido: {{ $foto->created_at->format('d/m/Y') }}</p>

								</div>

								<div class="foto-footer">
									<a href="{{ route('negocio.eliminar.foto' , $foto->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							</div>
							
					</div>
					@endforeach
				</div>
			</div>
			
			</div>

		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<script>
	lat = $('#lat').val();
	long = $('#long').val();

	mapboxgl.accessToken = 'pk.eyJ1Ijoiam95ZGlzZW5vcyIsImEiOiJjanhsNjl1OHMwMnVoM3hxZWtjamJxeGpoIn0.fsWaR9XzZr2IcBCNZCzQ6A';

	var map2 = new mapboxgl.Map({
	container: 'map', 
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [long, lat], 
	zoom: 13
	});

	markerCurrent = new mapboxgl.Marker({
		draggable: true
	})
		.setLngLat([long, lat])
		.addTo(map2);

	map2.on('click', function(e) {

    lngLat = e.lngLat;
    console.log(lngLat);

    		markerCurrent
    		.setLngLat(lngLat)
    		.addTo(map2);

    		$('#lat').val(lngLat.lat);
    		$('#long').val(lngLat.lng);
    

    });

     function onDragEnd() {
		lngLat = markerCurrent.getLngLat();
		
		$('#lat').val(lngLat.lat);
	    $('#long').val(lngLat.lng);
	}
	 
	markerCurrent.on('dragend', onDragEnd);
</script>
@endsection