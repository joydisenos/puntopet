@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Membresía PET')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			
			@role('pet')
			<div class="row">
				<div class="col text-center">
					<h5>Eres un usuario PET!</h5>
					<p>Disfruta de los mejores descuentos y promociones que ofrece nuestra plataforma</p>
				</div>
			</div>
			@else
			<!--<div class="row">
				<div class="col text-center">
					<h5>Si te conviertes en usuario PET recibirás descuentos especiales para tus futuras compras!</h5>
				</div>
			</div>
			
			<div class="row">
				<div class="col text-center">
					<img src="{{ asset('images/paw.png') }}" style="max-width: 200px" class="img-fluid d-block mb-4 mx-auto" alt="">
					<br>
					<a href="{{ route('usuario.membresia.aumentar') }}" class="btn btn-primary">Contratar membresía</a>
				</div>
			</div>-->

			<div class="row">
				<div class="col text-center">
					<h5>Pronto podrás adquirir más beneficios y descuentos para tus futuras compras!</h5>
					<h2>Usuario PET</h2>
				</div>
			</div>
			
			<div class="row">
				<div class="col text-center">
					<img src="{{ asset('images/paw.png') }}" style="max-width: 200px" class="img-fluid d-block mb-4 mx-auto" alt="">
				</div>
			</div>
			@endrole
			

		</div>
	</div>
</div>
@endsection