<div class="row mb-4">
						<input type="hidden" name="latitud" id="lat" class="direcciones" value="{{ $negocio != null ? $negocio->latitud: '-33.4372' }}">
						<input type="hidden" name="longitud" id="long" class="direcciones" value="{{ $negocio != null ? $negocio->longitud: '-70.6506' }}">

						<div class="col-md-4">
							<p>Nombre del Negocio</p>
						</div>
						<div class="col">
							<input type="text" name="nombre" value="{{ $negocio != null ? $negocio->nombre : '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Tipo de Negocio</p>
						</div>
						<div class="col">
							<select name="clase_id" id="" class="form-control">
								<option value="">Seleccione un tipo</option>
								@foreach(App\Clase::all() as $tipo)
								<option value="{{ $tipo->id }}" {{ $negocio != null && $negocio->clase_id == $tipo->id ? 'selected'  : '' }}>{{ str_slug($tipo->nombre) }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Dirección</p>
						</div>
						<div class="col">
							<input type="text" name="direccion" id="direccion" value="{{ $negocio != null ? $negocio->direccion: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Ciudad</p>
						</div>
						<div class="col">
							<select name="ciudad_id" class="form-control ciudad-select">
								<option>Seleccione su Ciudad</option>
								@foreach(App\Ciudad::ciudades() as $ciudad)
								<option value="{{ $ciudad->id }}" {{ $negocio != null && $negocio->ciudad_id == $ciudad->id? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Comuna</p>
						</div>
						<div class="col">
							<select name="comuna_id" class="form-control">
								<option>Seleccione su Comuna</option>
								@foreach(App\Comuna::comunas() as $comuna)
								<option value="{{ $comuna->id }}" class="ocultar comunas-list c-{{ $comuna->ciudad_id }}" {{ $negocio != null && $negocio->comuna_id == $comuna->id? 'selected' : '' }}>{{ $comuna->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div id="map"></div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Teléfono</p>
						</div>
						<div class="col">
							<input type="text" name="telefono" value="{{ $negocio != null ? $negocio->telefono: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Email de contacto</p>
						</div>
						<div class="col">
							<input type="email" name="email" value="{{ $negocio != null ? $negocio->email: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Breve descripción</p>
						</div>
						<div class="col">
							<textarea name="descripcion" id="" class="form-control" cols="30" rows="10">{{ $negocio != null ? $negocio->descripcion : '' }}</textarea>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Persona de contacto</p>
						</div>
						<div class="col">
							<input type="text" name="contacto" value="{{ $negocio != null ? $negocio->contacto: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Twitter</p>
						</div>
						<div class="col">
							<input type="text" name="twitter" value="{{ $negocio != null ? $negocio->twitter: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Facebook</p>
						</div>
						<div class="col">
							<input type="text" name="facebook" value="{{ $negocio != null ? $negocio->facebook: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Instagram</p>
						</div>
						<div class="col">
							<input type="text" name="instagram" value="{{ $negocio != null ? $negocio->instagram: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Youtube</p>
						</div>
						<div class="col">
							<input type="text" name="youtube" value="{{ $negocio != null ? $negocio->youtube: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>LinkedIn</p>
						</div>
						<div class="col">
							<input type="text" name="linkedin" value="{{ $negocio != null ? $negocio->linkedin: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Google+</p>
						</div>
						<div class="col">
							<input type="text" name="googleplus" value="{{ $negocio != null ? $negocio->googleplus: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Logotipo del Negocio</p>
						</div>
						<div class="col">
							<input type="file" name="logo_local" class="form-control">
						</div>
					</div>

					@if( $negocio != null && $negocio->logo_local != null  )

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . $negocio->logo_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto del Negocio</p>
						</div>
						<div class="col">
							<input type="file" name="foto_local" class="form-control">
						</div>
					</div>

					@if( $negocio != null && $negocio->foto_local != null  )

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . $negocio->foto_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif