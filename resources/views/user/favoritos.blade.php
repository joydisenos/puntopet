@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Favoritos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<h6 class="mb-4">Aún no tienes favoritos, explora todas las mejores tiendas y hogares para tu mascota!</h6>
						<a href="{{ route('tiendas') }}" class="btn btn-primary">Tiendas</a>
						<a href="{{ route('hogares') }}" class="btn btn-primary">Hogares</a>
			
		</div>
	</div>
</div>
@endsection