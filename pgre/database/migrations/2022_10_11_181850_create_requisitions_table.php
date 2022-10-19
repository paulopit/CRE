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
            $table->string('tag');
            $table->foreignId('request_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('requisition_levels')->onDelete('cascade');
            $table->integer('request_days')->nullable();
            $table->date('end_date')->nullable();
            $table->string('obs')->nullable();
            $table->string('course')->nullable();
            $table->string('class')->nullable();
            $table->string('ufcd')->nullable();
            $table->string('teacher')->nullable();
            $table->foreignId('approved_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('approved')->default(0);
            $table->boolean('request_status')->default(0);
            $table->boolean('deliver_status')->default(0);
            $table->string('pickup_name')->nullable();
            $table->string('deliver_name')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('deliver_at')->nullable();
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
        Schema::dropIfExists('requisitions');
    }
}
