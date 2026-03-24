<?php
#Migración Guia 6
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
        Schema::create('insumos', function (Blueprint $table){
            $table->id();
            $table->string('name',100)->notNull();
            $table->string('unidad',40)->notNull();
            $table->integer('cantidad')->notNull();
            $table->text('categoria')->nullable()->default(null);
            $table->string('proveedor',100)->notNull();
        });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
