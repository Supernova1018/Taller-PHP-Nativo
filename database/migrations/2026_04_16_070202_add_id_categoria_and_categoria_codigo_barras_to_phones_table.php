<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('phones', function (Blueprint $table) {

        // Llave foránea
        $table->unsignedBigInteger('id_categoria');

        $table->foreign('id_categoria')
              ->references('id_categoria')
              ->on('categorias')
              ->onDelete('cascade');

        // Campo código de barras
        $table->string('codigo_barras');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('phones', function (Blueprint $table) {

        $table->dropForeign(['id_categoria']);
        $table->dropColumn(['id_categoria', 'codigo_barras']);
    });
}
};
