<div class="row mb-4">
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
							<p>Breve descripción</p>
						</div>
						<div class="col">
							<textarea name="descripcion" id="" class="form-control" cols="30" rows="10">{{ $hogar != null ? $hogar->descripcion : '' }}</textarea>
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