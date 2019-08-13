@extends('master.front')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
	.negocio-row{
		margin-bottom: 20px;
		padding: 20px;
		box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
		transition: all ease .5s;
	}
	.negocio-row:hover{
		transform: translateY(-10px);
		box-shadow: 5px 5px 30px rgba(0,0,0,0.3);
	}
</style>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Productos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<div class="row">
					<div class="col mb-4 text-right">
						<a href="{{ route('negocio.crear.producto') }}" class="btn btn-primary">
							Nuevo Producto
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col">
						@if($productos->count() == 0)
						<div class="text-center">
							<h6 class="mb-4">Aún no tienes productos registrados</h6>
						</div>
						@else
						<div class="row mb-4">
							<div class="col">
								<input type="text" id="buscar" class="form-control" placeholder="Buscar">
							</div>
						</div>

						@foreach($productos as $producto)

						<div class="row negocio-row card-filter">
								<div class="col-4 text-center">
									@if($producto->foto == null)
									<img src="{{ asset('images/paw.png') }}" class="img-fluid" alt="Imagen {{ $producto->nombre }}">
									@else
									<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . $producto->foto) }}" class="img-fluid" alt="Imagen {{ $producto->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($producto->nombre) }}</strong></h3>

									<div class="row">
										<div class="col">
												<h6>Negocio: {{ title_case($producto->negocio->nombre) }}</h6>
												<h6>Ventas: {{ $producto->ventas->count() }}</h6>
												<h6>Total: ${{ number_format($producto->precio * $producto->ventas->count() , 0 , ',' , '.') }}</h6>
												<h6>Estatus: {{ $producto->estatusProducto($producto->estatus) }}</h6>
										
										</div>
										<div class="col">
											
											<a href="{{ route('negocio.modificar.producto' , [$producto->id]) }}" class="btn btn-primary mb-2 m-md-0">Modificar</a>
											<input type="checkbox" class="cambiar_estatus mb-2 m-md-0" data-idproducto="{{ $producto->id }}" {{ $producto->estatus == 1? 'checked' : ''}} data-on="Activo" data-off="Desactivado" data-toggle="toggle">
											
										</div>
									</div>

								</div>
							</div>
						
						
						@endforeach


						@endif
					</div>
				</div>
			
			
		</div>
	</div>
</div>
@endsection
@section('scripts')
	@include('includes.busqueda')
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script>
		$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
		
		$('.cambiar_estatus').change(function(){

			button = $(this);
			id = button.data('idproducto');

			$.ajax({

	           type:'POST',

	           url:"{{route('producto.actualizar.estatus')}}",

	           data:{ id:id },

	           success:function(data){
	           	console.log(data);

	           	if(data.estatus == 1)
	           	{
	           		button.prop('checked' , true);
	           	}else{
	           		button.prop('checked' , false);
	           	}

	           }

	        });

		});
		
	</script>
@endsection