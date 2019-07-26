@extends('master.front')
@section('header')
<style>
    .imagen-tienda{
        height: 200px;
        background-size: cover;
        background-position: center center;
    }
    .fondo{
    	width: 100%;
    	height: 100%;
    	background: rgba(0,0,0,0.5);
    }
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Favoritos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4 align-items-center d-flex justify-content-center">

			<div class="row">
				<div class="col text-center">
					
						<h3 class="color-primary mb-4">Bienvenid@, {{ title_case(Auth::user()->nombre) }} {{ title_case(Auth::user()->apellido) }}</h3>
						 	<p class="mb-4">Estás registrado como @role('admin') Administrador @else @role('negocio') Negocio @elserole('hogar') Hogar @else Usuario @endrole @endrole</p>
						
						@role('negocio')

						@if(Auth::user()->productos->count() == 0)
							<h6 class="mb-4">Aún no tienes productos registrados</h6>
							<a href="{{ route('negocio.crear.producto') }}" class="btn btn-primary">Registrar Producto</a>
							@endif

						<div class="row">
							
							@foreach(Auth::user()->productos as $producto)
								<div class="col-md-4 mb-4">
									<a href="{{ route('negocio.modificar.producto' , [$producto->id]) }}">
									<div class="card" style="height: 100%;">
									  <div class="card-body p-0" style="background: url('{{ asset('storage/archivos/' . Auth::user()->id . '/' . $producto->foto) }}') center center; background-size: cover;">
									    <div class="fondo p-3">
									    	<h6 class="text-white"><strong>{{ title_case($producto->nombre) }}</strong></h6>
											<p class="text-white">{{ str_limit($producto->descripcion , 30) }}</p>
									    </div>
									  </div>
									</div>
									</a>
								</div>
							@endforeach
						</div>
						@elserole('hogar')
						@else
						<h6 class="mb-4">Explora todas las mejores tiendas y hogares para tu mascota!</h6>
						<a href="{{ route('tiendas') }}" class="btn btn-primary">Tiendas</a>
						<a href="{{ route('hogares') }}" class="btn btn-primary">Hogares</a>
						@endrole
						
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection