@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , title_case($post->titulo))
@endcomponent
@include('includes.compartir')

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">
			<header class="section-header">
				<h3>{{ title_case($post->titulo) }}</h3>
			</header>

			<div class="text-right">
				<span>Autor: {{ title_case($post->user->nombre) }} {{ title_case($post->user->apellido) }}</span><br>
				<span>Publicado: {{ $post->created_at->format('d/m/Y') }}</span>
			</div>
			
			<div class="mt-4 mb-4">
				{!! $post->mensaje !!}
			</div>
			
			<div class="row mt-4 mb-4">
			@if($post->anteriorPost() != null)
				<div class="col text-left">
					<a href="{{ route('ver.blog' , $post->anteriorPost()->slug) }}"><i class="fa fa-arrow-left"></i> <strong>{{ $post->anteriorPost()->titulo }}</strong></a>
				</div>
			@endif

			@if($post->siguientePost() != null)
				<div class="col text-right">
					<a href="{{ route('ver.blog' , $post->siguientePost()->slug) }}"><strong>{{ $post->siguientePost()->titulo }}</strong> <i class="fa fa-arrow-right"></i> </a>
				</div>
			@endif
			</div>


			<hr>
			
			@if($post->comentarios->count() > 0)
			<header class="section-header">
				<h3>Comentarios</h3>
			</header>
			@else
			<header class="section-header">
				<h3>Aún no tiene comentarios</h3>
			</header>
			@endif

			@foreach($post->comentarios as $comentario)
			<div class="row mb-4">
				<div class="col-md-3 text-center">
					@if($comentario->user->foto_perfil == null)
					<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded mb-4" alt="">
					@else
					<img src="{{ asset('storage/archivos/' . $comentario->user->id . '/' . $comentario->user->foto_perfil) }}" style="max-width: 100px;" class="img-fluid rounded mb-4" alt="">
					@endif
					<p class="mb-0 pb-0">{{ $comentario->user->nombre }} {{ $comentario->user->apellido }}</p>
					<p>{{ $comentario->created_at->format('d/m/Y') }}</p>
				</div>

				<div class="col">
					<h6><strong>{{ $comentario->titulo }}</strong></h6>
					<p>{{ $comentario->mensaje }}</p>
				</div>
			</div>
			@endforeach


			@guest
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="section-header">
						<h3>Comentarios</h3>
						<p>Para comentar deber tener tener una cuenta y estar logeado, <a href="{{ route('login') }}">ya tengo una cuenta</a>, <a href="{{ route('register') }}">registrarme</a></p>
					</div>
				</div>
			</div>
			@else
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="section-header">
						<h3>Comenta</h3>
						<p>Puedes dejar un comentario sobre el post {{ title_case($post->titulo) }} para aclarar todas tus dudas</p>
					</div>
				</div>
				<div class="col-md-8">
					<form action="{{ route('usuario.comentar.post' , $post->id) }}" method="post">
						@csrf
						
						<input type="text" class="form-control mb-3" name="titulo" placeholder="Asunto">
						<textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control mb-3" placeholder="Mensaje"></textarea>
						<button type="submit" class="btn btn-primary">Comentar</button>
					</form>
				</div>
			</div>
			@endguest
		</div>
	</div>
</div>
@endsection