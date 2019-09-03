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
    @slot('titulo' , 'Mis Foros')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row">
					<div class="col mb-4 text-right">
						
						<a href="{{ route('usuario.crear.post') }}" class="btn btn-primary">
							Crear Post
						</a>
						
					</div>
				</div>

				@if($posts->count() == 0)
				<div class="row">
					<div class="col">
						<header class="section-header">
							<h3>Aún no tienes post publicados</h3>
						</header>
					</div>
				</div>
				@endif

			
						@foreach($posts as $post)
						
							<div class="row negocio-row">
								<div class="col-4 text-center">
									@if($post->imagen == null)
									<img src="{{ asset('images/paw.png') }}" style="max-height: 150px;" class="img-fluid" alt="{{ $post->nombre }}">
									@else
									<img src="{{ asset( 'storage/archivos/'. $post->user->id . '/' . $post->imagen) }}" style="max-height: 150px;" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $post->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($post->titulo) }}</strong></h3>

									<div class="row">
										<div class="col">
												<h6>Comentarios: #</h6>
										</div>
										<div class="col">
											
											<a href="{{ route('usuario.editar.post' , [ 'slug' => $post->slug] ) }}" class="btn btn-primary">Editar</a>
											<a href="#" class="btn btn-primary">Visible</a>
											
										</div>
									</div>

								</div>
							</div>
						
						@endforeach
					
			
			
			
		</div>
	</div>
</div>


	
@endsection