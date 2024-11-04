<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_has_materiais', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId(column: 'material_id')->constrained('materiais')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_has_materiais');
    }
};
