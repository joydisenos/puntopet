<section class="header-panel">
	<div class="pantalla  d-flex align-items-end p-4">
		<div class="container">
			

			<div class="row">
				<div class="col-9 align-items-center d-flex">
				{{ $logo }}
				<h4 class="text-white d-inline">{{$titulo}}</h4>
			</div>
			<div class="col text-right">
				@guest
				@else

					<a href="#" id="favorito-btn" rel="{{ $negocio_id }}">
						<h4 class="text-{{ Auth::user()->esFavoritoTienda($negocio_id) ? 'danger' : 'white'}}" id="icono-fav"><i class="fa fa-heart"></i></h4>
					</a>
				@endguest
			</div>
			</div>
			
			
		</div>
	</div>

</section>