@extends('master.front')

@section('header')
<style>
	.fondo-foto{
		height: 300px;
		width:100%;
		background-size: cover;
		background-position: center center;
	}
	.fondo{
		height: 100%;
		width: 100%;
		background: rgba(0,0,0,0.4);
		color: #ffffff;
		padding:30px;
		transition: all ease .5s;
	}
	.fondo:hover{
		background: rgba(0,0,0,0.7);
	}
	.fondo h3{
		border-bottom: solid medium #18d26e;
		font-weight: bold;
	}
	.fondo p{
		opacity: 0;
		transform: translateY(100px);
		transition: all ease .5s;
	}
	.fondo:hover p{
		opacity: 1;
		transform: translateY(0);
	}
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Tiendas')
@endcomponent

<div class="container">
	<div class="row">
		
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<div class="row">
				<div class="col-md-4 m-0 p-0 p-md-1">
					<a href="#">
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
						<div class="fondo">
							<h3>Nombre de la tienda</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec sem ac massa mollis finibus. Aliquam molestie bibendum lacinia.</p>
						</div>
					</div>
					</a>
				</div>	

				<div class="col-md-4 m-0 p-0 p-md-1">
					<a href="#">
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
						<div class="fondo">
							<h3>Nombre de la tienda</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec sem ac massa mollis finibus. Aliquam molestie bibendum lacinia.</p>
						</div>
					</div>
					</a>
				</div>	

				<div class="col-md-4 m-0 p-0 p-md-1">
					<a href="#">
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
						<div class="fondo">
							<h3>Nombre de la tienda</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec sem ac massa mollis finibus. Aliquam molestie bibendum lacinia.</p>
						</div>
					</div>
					</a>
				</div>	

				<div class="col-md-4 m-0 p-0 p-md-1">
					<a href="#">
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
						<div class="fondo">
							<h3>Nombre de la tienda</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec sem ac massa mollis finibus. Aliquam molestie bibendum lacinia.</p>
						</div>
					</div>
					</a>
				</div>	

				<div class="col-md-4 m-0 p-0 p-md-1">
					<a href="#">
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
						<div class="fondo">
							<h3>Nombre de la tienda</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec sem ac massa mollis finibus. Aliquam molestie bibendum lacinia.</p>
						</div>
					</div>
					</a>
				</div>	
			</div>

		</div>


	</div>
</div>
@endsection