<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('serial_number')->unique();
            $table->boolean('status_ok')->default('0');
            $table->foreignId('equipment_type_id')->constrained();
            $table->foreignId('equipment_model_id')->constrained();
            $table->boolean('in_stock')->default(1);
            $table->string('reference');
            //$table->foreignId('reference')->unique()->constrained('equipment_images')->onDelete('cascade');
            $table->string('obs')->nullable();
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
        Schema::dropIfExists('equipment');
    }
}
