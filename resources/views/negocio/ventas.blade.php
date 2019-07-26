@extends('master.front')
@section('header')
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
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Negocios registrados')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row">
					<div class="col mb-4 text-right">
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar_negocio">
							Crear Negocio
						</a>
					</div>
				</div>

			
						@foreach($negocios as $negocio)
						
							<div class="row negocio-row">
								<div class="col-4 text-center">
									@if($negocio->logo_local == null)
									<img src="{{ asset('images/paw.png') }}" style="max-height: 150px;" class="img-fluid" alt="{{ $negocio->nombre }}">
									@else
									<img src="{{ asset( 'storage/archivos/'. $negocio->user->id . '/' . $negocio->logo_local) }}" style="max-height: 150px;" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $negocio->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($negocio->nombre) }}</strong></h3>

									<div class="row">
										<div class="col">
												<h6>Clicks registrados: {{ $negocio->visitas() }}</h6>
												<h6>Ventas: {{ $negocio->ventas->count() }}</h6>
												<h6>Total: ${{ number_format($negocio->ventas->sum('total') , 0 , ',' , '.') }}</h6>
										
										</div>
										<div class="col">
											
											<a href="{{ route('negocio.ventas.negocio' , [$negocio->slug]) }}" class="btn btn-primary">Ventas</a>
											<a href="{{ route('negocio.editar' , $negocio->id) }}" class="btn btn-primary">Modificar</a>
											
										</div>
									</div>

								</div>
							</div>
						
						@endforeach
					
			
			
			
		</div>
	</div>
</div>


	<!-- Modal -->
				<div class="modal fade" id="agregar_negocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header background-primary">
				        <h6 class="modal-title text-white" id="exampleModalLongTitle">Agregar Negocio</h6>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

				      	<form action="{{ route('negocio.agregar') }}" method="post">
				      		@csrf

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		
				        		@component('components.negocios')
				        		@slot('negocio' , null)
				        		@endcomponent
				        	</div>
				        </div>

				       

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		<button class="btn btn-primary btn-block">
				        			Agregar
				        		</button>
				        	</div>
				        </div>

				        </form>

				      </div>
				     
				    </div>
				  </div>
				</div>
@endsection