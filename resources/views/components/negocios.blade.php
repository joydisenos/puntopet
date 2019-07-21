<div class="row mb-4">
						<div class="col-md-4">
							<p>Nombre del Negocio</p>
						</div>
						<div class="col">
							<input type="text" name="nombre" value="{{ $negocio != null ? $negocio->nombre : '' }}" class="form-control">
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-md-4">
							<p>Dirección</p>
						</div>
						<div class="col">
							<input type="text" name="direccion" value="{{ $negocio != null ? $negocio->direccion: '' }}" class="form-control">
						</div>
					</div>

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
							<p>Breve descripción</p>
						</div>
						<div class="col">
							<textarea name="descripcion" id="" class="form-control" cols="30" rows="10">{{ $negocio != null ? $negocio->descripcion : '' }}</textarea>
						</div>
					</div>

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