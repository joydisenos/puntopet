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
    @slot('titulo' , 'Editar ' . title_case($negocio->nombre))
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.actualizar' , [$negocio->id]) }}" method="post" enctype="multipart/form-data">
				@csrf

				@component('components.negocios')
				@slot('negocio' , $negocio)
				@endcomponent

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-primary">
							Actualizar
						</button>
					</div>
				</div>

			</form>
			
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
	zoom: 9 
	});

	markerCurrent = new mapboxgl.Marker()
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

</script>
@endsection