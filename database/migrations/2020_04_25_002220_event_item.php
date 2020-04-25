<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_item', function (Blueprint $table) {
            $table->bigInteger('model_id');
            $table->string('name');
            $table->tinyInteger('active');
            $table->string('model_type');

            $table->primary(['model_id'], 'event_item_has_model_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_item');
    }
}
