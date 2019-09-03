@extends('master.front')

@section('header')
<style>
	.post-item{
		margin-bottom: 20px;
		box-shadow: 0px 0px 0px rgba(0,0,0,0.0);
		transition: all ease .5s;
	}
	.post-item:hover{
		transform: translateY(-10px);
		box-shadow: 5px 5px 30px rgba(0,0,0,0.3);
	}

	.post-no-img{
		background-image: url('{{ asset('img/freddy-anca-chuquihumani-1055220-unsplash.jpg') }}') !important;
		background-position: center center;
		background-size: cover;
		height: 200px;
		width: 100%;
	}

	.post-img{
		background-position: center center;
		background-size: cover;
		height: 200px;
		width: 100%;
	}
</style>
@endsection


@section('content')

@component('components.header')
    @slot('titulo' , 'Foro')
@endcomponent

<div class="text-white bg-primary text-right p-2 rounded-right busqueda-toggle" id="btn-filtro">
		<i class="fa fa-filter"></i>
</div>

<section style="min-height: 500px">
	<div class="container">
	<div class="row">

		<div class="col-md-2 pt-4 pb-4 mt-4 mb-0" id="filtros-buscar">

			
			
			<div class="row">
				<div class="col">
					<h6 class="text-center color-primary"><strong>Búsqueda</strong></h6>
					<hr class="color-primary">
				<form action="{{ route('buscar.post.nombre') }}" class="form-buscar">
					<input type="text" placeholder="Nombre" class="form-control bg-primary text-white mb-3" value="{{ isset($_GET['nombre']) ? $_GET['nombre'] : '' }}" name="nombre">

					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</form>
				
				

				</div>
			</div>

			
			
		</div>

		<div class="col pt-4">

		@if($posts->count() == 0)

		<div class="row pt-4">
			<div class="col">
				<header class="section-header">
					<h3>Aún no hay posts registrados</h3>
				</header>
			</div>
		</div>
 

		@else

							<div class="row">
						@foreach($posts as $post)
						
						<div class="col-md-4 mb-4">

							<div class="post-item">
								<a href="{{ route('ver.blog' , $post->slug) }}">
									@if($post->imagen == null)
									<div class="post-no-img"></div>
									@else
									<div class="post-img" style="background-image: url('{{ asset('storage/archivos/' . $post->user->id . '/' . $post->imagen) }}');"></div>
									@endif
								</a>
							
							<div class="p-4">
								<a href="{{ route('ver.blog' , $post->slug) }}">
									<h6 class="text-center"><strong>{{ title_case($post->titulo) }}</strong></h6>
								</a>

								<p>{{ str_limit(strip_tags($post->mensaje) , 100) }}</p>

								<h6>Por: <strong>{{ title_case($post->user->nombre) }} {{ title_case($post->user->apellido) }}</strong></h6>
								<h6>Publicado: <strong>{{ $post->created_at->format('d/m/Y') }}</strong></h6>
							</div>
							
							</div>
						
						</div>
						
						@endforeach
							</div>


		@endif

		</div>
		
	</div>
	</div>
</section>

@endsection