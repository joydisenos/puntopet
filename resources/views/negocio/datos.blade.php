@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mis Datos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">


				<form action="{{ route('negocio.actualizar.datos') }}" method="post" enctype="multipart/form-data">
					@csrf

					

					<div class="row mb-4">
						<div class="col text-right">
							<button type="submit" class="btn btn-primary">
								Actualizar
							</button>
						</div>
					</div>

					

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Nombre</p>
						</div>
						<div class="col">
							<h6>{{ title_case(Auth::user()->nombre) }} {{ title_case(Auth::user()->apellido) }}</h6>
						</div>
					</div>

					


					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto de Perfil</p>
						</div>
						<div class="col">
							<input type="file" name="foto_perfil" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Teléfono</p>
						</div>
						<div class="col">
							<input type="number" name="telefono" class="form-control" value="{{ Auth::user()->telefono }}">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Cambiar Contraseña</p>
						</div>
						<div class="col">
							<input type="password" name="password" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Confirme su Contraseña</p>
						</div>
						<div class="col">
							<input type="password" name="password_confirmation" class="form-control">
						</div>
					</div>
					
					@role('negocio|dev')
					<div class="row mb-4">
						<div class="col"><h6>
							Datos de Negocios Registrados
						</h6></div>
						<div class="col text-right">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar_negocio">Crear Negocio</a>
						</div>
					</div>
					@elserole('hogar|dev')
					<div class="row mb-4">
						<div class="col"><h6>
							Datos de Hogares Registrados
						</h6></div>
						<div class="col text-right">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar_hogar">Crear Hogar</a>
						</div>
					</div>
					@endrole


					@foreach( Auth::user()->negocios as $negocio )

					<div class="row mb-4">
						<div class="col-md-4">
							<p>{{ $negocio->nombre }}</p>
						</div>
						<div class="col">
							<p>Clicks registrados: {{ $negocio->visitas() }}</p>
						</div>
						<div class="col text-right">
							<a href="{{ route('negocio.editar' , $negocio->id) }}" class="btn btn-primary">Modificar</a>
						</div>
					</div>

					@endforeach

					@foreach( Auth::user()->hogares as $hogar )

					<div class="row mb-4">
						<div class="col-md-4">
							<p>{{ $hogar->nombre }}</p>
						</div>
						<div class="col">
							<p>Mascotas registradas: {{ $hogar->mascotas->count() }}</p>
							<p>Clics registrados: {{ $hogar->visitas() }}</p>
						</div>
						<div class="col text-right">
							<a href="{{ route('hogar.editar' , $hogar->id) }}" class="btn btn-primary">Modificar</a>
						</div>
					</div>

					@endforeach

					

				


				</form>
			
			
		</div>
	</div>
</div>
@role('negocio|dev')
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
					@elserole('hogar|dev')
					<!-- Modal -->
				<div class="modal fade" id="agregar_hogar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header background-primary">
				        <h6 class="modal-title text-white" id="exampleModalLongTitle">Agregar Negocio</h6>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

				      	<form action="{{ route('hogar.agregar') }}" method="post">
				      		@csrf

				        <div class="row justify-content-center mb-3">
				        	<div class="col-10">
				        		
				        		@component('components.hogares')
				        		@slot('hogar' , null)
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
					@endrole

@endsection