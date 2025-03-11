<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('papeleria')) {
            Schema::create('papeleria', function (Blueprint $table) {
                $table->id('id_papeleria');
                $table->string('tipo_papeleria');
                $table->string('cantidad_papeleria');
                $table->string('oficina_papeleria');
                $table->date('fecha_papeleria')->nullable();
                $table->date('fechaAsesor_papeleria')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()  // Quita el ": void"
    {
        Schema::dropIfExists('papeleria');
    }
};
