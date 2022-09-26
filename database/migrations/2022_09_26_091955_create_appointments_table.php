<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('shop_id')->constrained('shops');

            $table->foreignId('service_id')->constrained('services');

            $table->foreignId('user_id')->constrained('users');

            $table->foreignId('rota_id')->constrained('rotas');

            $table->foreignId('rota_metas_id')->constrained('rota_metas');

            $table->date('schedule_date');
            $table->time('schedule_start_time');
            $table->time('schedule_end_time');

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
        Schema::dropIfExists('appointments');
    }
}
