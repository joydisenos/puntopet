@extends('master.front')

@section('header')
<style>
	.fotos{
		height: 200px;
		width: 100%;
	}
	.card{
		position: relative;
		transition: all ease .5s;
	}
	.card:hover{
		box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
		transform: translateY(-5px);
	}
	.floating{
		position: absolute;
		bottom: 10px;
		right: 10px;
	}
	.nav-pills .nav-link.active, .show>.nav-pills .nav-link{
		background-color: #18D26E !important;
	}
	.logo-tienda{
		max-width: 50px;
		margin-bottom: 8px;
	}
	.contenedor-carrito{
		max-width: 150px;
	}
	.header-panel{
		min-height: 200px !important;
	}
	@if($tienda->foto_local != null )
	.header-panel{
		background-image: url('{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->foto_local ) }}') !important;
		background-position: center center;
		background-size: cover;
	}
	@endif

</style>
@endsection

@section('content')

@component('components.headertienda')
	@slot('logo')
		@if($tienda->logo_local != null)
		 <img src="{{ asset( 'storage/archivos/'. $tienda->id . '/' . $tienda->logo_local) }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre }}">
		@else
		 <img src="{{ asset('images/paw.png') }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre }}">
		@endif
	@endslot
    @slot('titulo' , title_case($tienda->nombre))
    @slot('puntos')
    	
    @endslot
@endcomponent

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#productos" role="tab" aria-controls="pills-home" aria-selected="true">Productos</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#informacion" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
					  </li>
					</ul>
				</div>
			</div>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="pills-home-tab">
				
				@if($productos->count() > 0)
				<div class="row">
					<div class="col">
						<h4>Productos</h4>
						<hr>
					</div>
				</div>
				@endif

				<div class="row mb-4 d-flex align-items-stretch">
					@foreach($productos as $producto)
					<div class="col-md-4 mb-4">
						<div class="card" style="height: 100%;">
						
						@if($producto->foto == null)
						<div class="fotos" style="background: url('{{ asset('img/channey-528973-unsplash.jpg') }}') center center; background-size: cover;"></div>
						@else
						  <div class="fotos" style="background: url('{{ asset('storage/archivos/' . $tienda->id . '/' . $producto->foto) }}') center center; background-size: cover;"></div>
						@endif

						  <div class="card-body">
						    <h6>{{ title_case($producto->nombre) }}</h6>
							<p>{{ $producto->descripcion }}</p>
							<form action="#" method="get">
								@csrf
				
								<h6>${{ number_format($producto->precio) }}</h6>
							
								<button type="submit" class="btn btn-primary rounded-circle btn-small floating">
									<i class="fa fa-plus"></i>
								</button>
							</form>
						  </div>
						</div>
					</div>
					@endforeach
				</div>

					
					  </div>
					  <div class="tab-pane fade" id="informacion" role="tabpanel" aria-labelledby="pills-profile-tab">

					  	@if($tienda->descripcion != null)
					  	<div class="row mb-4">
					  		<div class="col">
					  			<p>{{ $tienda->descripcion }}</p>
					  		</div>
					  	</div>
					  	@endif
						
						@if($tienda->direccion != null)
					  	<div class="row mb-4">
					  		<div class="col">
					  			<p><strong>Dirección:</strong> {{ $tienda->direccion }}</p>
					  		</div>
					  	</div>
					  	@endif
						
						

					  </div>
					  
			</div>

					
					
				</div>

				<div class="col-4 pt-4 pb-4 mt-4 mb-4 d-none d-lg-block">
					<div class="row">
						<div class="col text-center border p-4">
							<h6 class="mb-4">Mi Pedido <span class="badge badge-danger">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/paw.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ $total += $carro->price * $carro->qty }}</div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ $total }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-danger">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>
				</div>
	</div>
</div>
@endsection