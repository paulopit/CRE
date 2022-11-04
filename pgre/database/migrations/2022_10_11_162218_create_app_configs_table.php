<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_configs', function (Blueprint $table) {
            $table->id();
            $table->string('conf_alert_emails')->nullable();
            $table->boolean('conf_alert_emails_check')->default(0);
            $table->integer('conf_low_stock_percentage');
            $table->boolean('conf_low_stock_percentage_check')->default(0);
            $table->integer('conf_default_req_days');
            $table->boolean('conf_default_req_days_check')->default(0);
            $table->integer('conf_default_expire_minutes');
            $table->boolean('conf_default_expire_minutes_check')->default(0);
            $table->string('conf_api_key');
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
        Schema::dropIfExists('app_configs');
    }
}
