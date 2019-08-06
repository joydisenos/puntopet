<div class="row mb-4">

						<input type="hidden" name="latitud" id="lat" value="{{ $hogar != null ? $hogar->latitud: '-33.4372' }}">
						<input type="hidden" name="longitud" id="long" value="{{ $hogar != null ? $hogar->longitud: '-70.6506' }}">

						<div class="col-md-4">
							<p>Nombre del Hogar</p>
						</div>
						<div class="col">
							<input type="text" name="nombre" value="{{ $hogar != null ? $hogar->nombre : '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Dirección</p>
						</div>
						<div class="col">
							<input type="text" name="direccion" value="{{ $hogar != null ? $hogar->direccion: '' }}" class="form-control">
						</div>
					</div>

					<div id="map"></div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Teléfono</p>
						</div>
						<div class="col">
							<input type="text" name="telefono" value="{{ $hogar != null ? $hogar->telefono: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Email de contacto</p>
						</div>
						<div class="col">
							<input type="email" name="email" value="{{ $hogar != null ? $hogar->email: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Breve descripción</p>
						</div>
						<div class="col">
							<textarea name="descripcion" id="" class="form-control" cols="30" rows="10">{{ $hogar != null ? $hogar->descripcion : '' }}</textarea>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Persona de contacto</p>
						</div>
						<div class="col">
							<input type="text" name="contacto" value="{{ $hogar != null ? $hogar->contacto: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Twitter</p>
						</div>
						<div class="col">
							<input type="text" name="twitter" value="{{ $hogar != null ? $hogar->twitter: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Facebook</p>
						</div>
						<div class="col">
							<input type="text" name="facebook" value="{{ $hogar != null ? $hogar->facebook: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Instagram</p>
						</div>
						<div class="col">
							<input type="text" name="instagram" value="{{ $hogar != null ? $hogar->instagram: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Youtube</p>
						</div>
						<div class="col">
							<input type="text" name="youtube" value="{{ $hogar != null ? $hogar->youtube: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>LinkedIn</p>
						</div>
						<div class="col">
							<input type="text" name="linkedin" value="{{ $hogar != null ? $hogar->linkedin: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Google+</p>
						</div>
						<div class="col">
							<input type="text" name="googleplus" value="{{ $hogar != null ? $hogar->googleplus: '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Logotipo del Hogar</p>
						</div>
						<div class="col">
							<input type="file" name="logo_local" class="form-control">
						</div>
					</div>

					@if( $hogar != null && $hogar->logo_local != null  )

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . $hogar->logo_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Foto del Hogar</p>
						</div>
						<div class="col">
							<input type="file" name="foto_local" class="form-control">
						</div>
					</div>

					@if( $hogar != null && $hogar->foto_local != null  )

					<div class="row mb-4">
						<div class="col-md-4">
							
						</div>
						<div class="col">
							<img src="{{ asset( 'storage/archivos/' . Auth::user()->id . '/' . $hogar->foto_local) }}" class="img-fluid" alt="">
						</div>
					</div>

					@endif