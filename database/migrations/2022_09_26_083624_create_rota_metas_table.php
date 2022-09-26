<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotaMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rota_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rota_id')->constrained('rotas');

            $table->date('date');

            $table->time('start_time');
            $table->time('end_time');

            $table->tinyInteger('active')->default('1'); // 0/1

            $table->string('slug'); // Leave, Holiday

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
        Schema::dropIfExists('rota_metas');
    }
}
