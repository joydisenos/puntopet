<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();
Route::post('/alta', 'UsuarioController@alta')->name('alta');
Route::post('/sugerir', 'UsuarioController@sugerir')->name('sugerir');
Route::get('/nosotros', 'HomeController@nosotros')->name('nosotros');
Route::get('/nosotros/{pagina}', 'HomeController@nosotros')->name('nosotros.pagina');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tiendas', 'HomeController@tiendas')->name('tiendas');
Route::get('/hogares', 'HomeController@hogares')->name('hogares');
Route::get('/tienda/{slug}', 'HomeController@tienda')->name('ver.tienda');
Route::get('/hogar/{slug}', 'HomeController@hogar')->name('ver.hogar');

Route::get('/agregarcarro/{id}', 'UsuarioController@agregarCarrito')->name('agregar.carrito');
Route::get('/eliminarcarro/{id}', 'UsuarioController@eliminarCarrito')->name('eliminar.carrito');

Route::post('/tienda/{slug}/pago', 'UsuarioController@pago')->name('pago')->middleware('auth');

Route::get('/tienda/{slug}/ordenar', 'UsuarioController@ordenar')->name('ordenar')->middleware('auth');

Route::get('/bienvenido', 'HomeController@bienvenido')->name('bienvenido')->middleware('auth');

Route::prefix('usuario')->group( function () {
		Route::get('/favoritos', 'UsuarioController@favoritos')->name('usuario.favoritos');
		Route::get('/direcciones', 'UsuarioController@direcciones')->name('usuario.direcciones');
		Route::post('/agregar/direccion', 'UsuarioController@agregarDireccion')->name('usuario.agregar.direccion');
		Route::get('/datos', 'UsuarioController@datos')->name('usuario.datos');
		Route::get('/pedidos', 'UsuarioController@pedidos')->name('usuario.pedidos');
		Route::post('/datos/actualizar', 'UsuarioController@actualizarDatos')->name('usuario.actualizar.datos');

		Route::get('/pedidos/orden/{id}', 'UsuarioController@verOrden')->name('usuario.ver.orden');
	});

Route::prefix('panel')->group( function () {
		Route::get('/productos', 'NegocioController@productos')->name('negocio.productos');
		Route::get('mascotas', 'NegocioController@mascotas')->name('negocio.mascotas');
		
		Route::get('/editar/negocio/{id}', 'NegocioController@editarNegocio')->name('negocio.editar');
		Route::get('/editar/hogar/{id}', 'NegocioController@editarHogar')->name('hogar.editar');
		
		Route::post('/actualizar/negocio/{id}', 'NegocioController@actualizarNegocio')->name('negocio.actualizar');
		Route::post('/actualizar/hogar/{id}', 'NegocioController@actualizarHogar')->name('hogar.actualizar');
		Route::post('/registrar/negocio', 'NegocioController@registrarNegocio')->name('negocio.agregar');
		
		Route::post('/registrar/hogar', 'NegocioController@registrarhogar')->name('hogar.agregar');
		
		Route::get('/negocios', 'NegocioController@ventas')->name('negocio.ventas');
		Route::get('/ventas/negocio/{slug}', 'NegocioController@ventasNegocio')->name('negocio.ventas.negocio');
		Route::get('/ventas/orden/{id}', 'NegocioController@verOrden')->name('negocio.ver.orden');
		
		Route::get('/datos', 'NegocioController@datos')->name('negocio.datos');
		Route::post('/datos/actualizar', 'NegocioController@actualizarDatos')->name('negocio.actualizar.datos');
		
		Route::get('/crear/producto', 'NegocioController@crearProducto')->name('negocio.crear.producto');
		Route::get('/crear/mascota', 'NegocioController@crearMascota')->name('negocio.crear.mascota');

		Route::post('/guardar/producto', 'NegocioController@guardarProducto')->name('negocio.guardar.producto');
		Route::get('/modificar/producto/{id}', 'NegocioController@modificarProducto')->name('negocio.modificar.producto');

		Route::post('/guardar/mascota', 'NegocioController@guardarMascota')->name('negocio.guardar.mascota');
		Route::get('/modificar/mascota/{id}', 'NegocioController@modificarMascota')->name('negocio.modificar.mascota');

		Route::post('/actualizar/producto/{id}', 'NegocioController@actualizarProducto')->name('negocio.actualizar.producto');
		Route::post('/actualizar/mascota/{id}', 'NegocioController@actualizarMascota')->name('negocio.actualizar.mascota');

		Route::get('/estatus/orden/{id}/{estatus}', 'NegocioController@estatusOrden')->name('negocio.estatus.orden');

		Route::post('/subir/fotos', 'NegocioController@subirFotos')->name('negocio.subir.fotos');
		Route::get('/eliminar/foto/{id}', 'NegocioController@eliminarFoto')->name('negocio.eliminar.foto');
		
		Route::get('/envios', 'NegocioController@envios')->name('negocio.envios');
		Route::post('/actualizarestatus', 'NegocioController@estatusNegocio')->name('negocio.actualizar.envio');
	});

Route::prefix('admin')->group( function () {
		Route::get('/configuraciones', 'AdminController@configuraciones')->name('admin.configuraciones');
		Route::get('/seccion/{pag}', 'AdminController@seccion')->name('admin.editar.seccion');
		Route::post('/seccion/{id}', 'AdminController@actualizarSeccion')->name('admin.actualizar.seccion');
		Route::get('/usuarios', 'AdminController@usuarios')->name('admin.usuarios');
		Route::get('/sesiones', 'AdminController@sesiones')->name('admin.sesiones');
		Route::get('/sesiones/{slug}', 'AdminController@sesionesNegocio')->name('admin.sesiones.negocio');
	});
