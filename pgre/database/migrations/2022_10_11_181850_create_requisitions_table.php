<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('requisition_levels')->onDelete('cascade');
            $table->integer('request_days');
            $table->date('end_date');
            $table->string('obs');
            $table->string('course');
            $table->string('class');
            $table->string('ufcd');
            $table->foreignId('approved_user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('approved')->default(0);
            $table->boolean('request_status')->default(0);
            $table->boolean('deliver_status')->default(0);
            $table->string('pickup_name');
            $table->string('deliver_name');
            $table->date('approved_at');
            $table->date('deliver_at');
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
        Schema::dropIfExists('requisitions');
    }
}
