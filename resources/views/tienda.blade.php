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
	.btn-carrito{
		position: fixed;
		bottom: 10px;
		left: 10px;
		box-shadow: 4px 4px 8px rgba(0,0,0,0.5);
		z-index: 999;
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

						<div class="fondo-foto"
							@if($producto->foto == null)
							style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
							@else 
							style="background-image: url('{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $mascota->foto ) }}');"
							@endif
							>
						
							<div class="fondo">
								<h6 class="border-bottom">{{ title_case($producto->nombre) }}</h6>
								<p>{{ $producto->descripcion }}</p>
								<p><a 
									@if($producto->foto == null)
									href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
									@else
									href="{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $producto->foto ) }}"
									@endif 
									rel="lightbox">Ampliar imagen</a></p>
									<form action="{{ route('agregar.carrito' , $producto->id) }}" method="get">
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

					  	@if($tienda->telefono != null)
					  	<div class="row mb-4">
					  		<div class="col">
					  			<p>{{ $tienda->telefono }}</p>
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
							<h6 class="mb-4">Mi Pedido <span class="badge badge-primary background-primary">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
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
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-primary">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>
				</div>
	</div>
</div>

<button class="btn btn-primary btn-carrito d-lg-none" data-toggle="modal" data-target="#carrito-mobile"><i class="fa fa-shopping-cart"></i> {{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</button>

 <div class="modal fade" id="carrito-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
              
              	<h6 class="modal-title" id="exampleModalLongTitle">Mi Pedido <span class="badge badge-primary background-primary">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

              	<div class="row">
						<div class="col text-center p-4">
							
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/icon-cake.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
										<div class="col"></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ number_format($totalMobile += $carro->price * $carro->qty , 0  , ',' , '.') }}</div>
										<div class="col"><a href="{{ route('eliminar.carrito' , $carro->rowId) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a></div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ number_format($totalMobile , 0  , ',' , '.') }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-primary">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>

              </div>
            </div>
          </div>
        </div>
@endsection