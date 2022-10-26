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
            $table->foreignId('request_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('requisition_levels')->onDelete('cascade');
            $table->integer('request_days')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('obs')->nullable();
            $table->string('course')->nullable();
            $table->string('class')->nullable();
            $table->string('ufcd')->nullable();
            $table->string('teacher')->nullable();

            $table->boolean('request_status')->default(0);
            $table->boolean('deliver_status')->default(0);

            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');

            $table->dateTime('canceled_at')->nullable();
            $table->foreignId('canceled_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('canceled_obs')->nullable();

            $table->dateTime('picked_up_at')->nullable();
            $table->string('picked_up_by')->nullable();

            $table->dateTime('delivered_at')->nullable();
            $table->foreignId('delivered_by')->nullable()->constrained('users')->onDelete('cascade');

            $table->dateTime('requested_at')->nullable();
            $table->foreignId('requested_by')->nullable()->constrained('users')->onDelete('cascade');

            $table->dateTime('returned_at')->nullable();
            $table->string('returned_by')->nullable();

            $table->dateTime('closed_at')->nullable();
            $table->string('closed_by')->nullable()->constrained('users')->onDelete('cascade');

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
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
