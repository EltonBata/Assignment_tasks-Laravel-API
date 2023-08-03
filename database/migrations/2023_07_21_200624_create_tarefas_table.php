<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrador_id');
            $table->foreign('administrador_id')->references('id')->on('funcionarios')->cascadeOnDelete();
            $table->unsignedBigInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('funcionarios');
            $table->foreignId('funcionario_id')->constrained();
            $table->string('designacao');
            $table->text('descricao');
            $table->dateTime('inicio');
            $table->dateTime('fim');
            $table->string('local')->nullable();
            $table->string('estado')->default('Em Progresso');
            $table->string('classificacao');
            $table->integer('progresso')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};