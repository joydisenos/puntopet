<div class="col-md-3 pt-4 pb-4 mt-4 mb-4">

	<div class="text-center">
		@if(Auth::user()->foto_perfil == null)
		<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded" alt="">
		@else
		<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . Auth::user()->foto_perfil) }}" style="max-width: 100px;" class="img-fluid rounded" alt="">
		@endif
		<h6 class="m-3">{{ title_case(Auth::user()->nombre) }}</h6>
	</div>
	<ul class="list-group list-group-flush">

		@role('admin|dev')
		<a href="{{ route('admin.usuarios') }}">
		  	<li class="list-group-item {{ (URL::current() == route('admin.usuarios')) ? 'active' : ''}}">
			  	<i class="fa fa-users mr-3" aria-hidden="true"></i> Usuarios
			</li>
		</a>

		<a href="{{ route('admin.configuraciones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('admin.configuraciones')) ? 'active' : ''}}">
			  	<i class="fa fa-cog mr-3" aria-hidden="true"></i> Configuraciones
			</li>
		</a>

		<a href="{{ route('admin.slider') }}">
		  	<li class="list-group-item {{ (URL::current() == route('admin.slider')) ? 'active' : ''}}">
			  	<i class="fa fa-check mr-3" aria-hidden="true"></i> Slider
			</li>
		</a>

		<a href="{{ route('admin.sesiones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('admin.sesiones')) ? 'active' : ''}}">
			  	<i class="fa fa-cog mr-3" aria-hidden="true"></i> Sesiones
			</li>
		</a>
		@else

		@role('negocio|dev')
		<a href="{{ route('negocio.productos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.productos')) ? 'active' : ''}}">
			  	<i class="fa fa-cubes mr-3" aria-hidden="true"></i> Productos
			</li>
		</a>

		<a href="{{ route('negocio.ventas') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.ventas')) ? 'active' : ''}}">
			  	<i class="fa fa-money mr-3" aria-hidden="true"></i> Negocios
			</li>
		</a>



		<a href="{{ route('negocio.datos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.datos')) ? 'active' : ''}}">
			  	<i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil
			</li>
		</a>

		<a href="{{ route('negocio.envios') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.envios')) ? 'active' : ''}}">
			  	<i class="fa fa-truck mr-3" aria-hidden="true"></i> Envíos y Pagos
			</li>
		</a>
		@elserole('hogar|dev')
		<a href="{{ route('negocio.datos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.datos')) ? 'active' : ''}}">
			  	<i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil
			</li>
		</a>

		<a href="{{ route('negocio.ventas') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.ventas')) ? 'active' : ''}}">
			  	<i class="fa fa-money mr-3" aria-hidden="true"></i> Hogares
			</li>
		</a>

		<a href="{{ route('negocio.mascotas') }}">
		  	<li class="list-group-item {{ (URL::current() == route('negocio.mascotas')) ? 'active' : ''}}">
			  	<i class="fa fa-paw mr-3" aria-hidden="true"></i> Mascotas
			</li>
		</a>
		@else
		<a href="{{ route('usuario.favoritos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.favoritos')) ? 'active' : ''}}">
			  	<i class="fa fa-heart mr-3" aria-hidden="true"></i> Favoritos
			</li>
		</a>
		<a href="{{ route('usuario.direcciones') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.direcciones')) ? 'active' : ''}}">
			  	<i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Direcciones
			</li>
		</a>
		<a href="{{ route('usuario.datos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.datos')) ? 'active' : ''}}">
			  	<i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil
			</li>
		</a>
		<a href="{{ route('usuario.membresia') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.membresia')) ? 'active' : ''}}">
			  	<i class="fa fa-star mr-3" aria-hidden="true"></i> Membresía
			</li>
		</a>
		<a href="{{ route('usuario.pedidos') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.pedidos')) ? 'active' : ''}}">
			  	<i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i> Pedidos
			</li>
		</a>
		@endrole

		@endrole

		<a href="{{ route('usuario.blog') }}">
		  	<li class="list-group-item {{ (URL::current() == route('usuario.blog')) ? 'active' : ''}}">
			  	<i class="fa fa-users mr-3" aria-hidden="true"></i> Foro
			</li>
		</a>

		<a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
		  	<li class="list-group-item">
			  	Salir
			</li>
		</a>
	</ul>

</div>