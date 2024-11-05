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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10, 2);
            $table->enum('status', ['Novo', 'Em Revisão', 'Alterações Solicitadas', 'Aprovado', 'Rejeitado']);
            $table->foreignId(column: 'solicitante_id')->constrained('users')->onDelete('cascade');
            $table->foreignId(column: 'grupo_id')->constrained('grupos')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos');
    }
};
