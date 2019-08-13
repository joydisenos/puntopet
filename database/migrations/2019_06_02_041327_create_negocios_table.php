<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('nombre')->nullable();
            $table->string('slug')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('destacado')->default(0);
            $table->integer('clase_id')->nullable();
            $table->string('ciudad_id')->nullable();
            $table->string('comuna_id')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('contacto')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('logo_local')->nullable();
            $table->string('foto_local')->nullable();
            $table->boolean('entrega_domicilio')->default(0);
            $table->boolean('entrega_local')->default(0);
            $table->boolean('tarjeta_delivery')->default(0);
            $table->boolean('envio_entrega')->default(0);
            $table->float('costo_envio')->nullable();
            $table->boolean('costo_fijo')->default(0);
            $table->boolean('envio_gratis')->default(0);
            $table->boolean('variable')->default(0);
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocios');
    }
}
