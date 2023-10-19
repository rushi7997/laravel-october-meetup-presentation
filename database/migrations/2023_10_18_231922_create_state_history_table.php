<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('state_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transition');
            $table->string('from');
            $table->string('to');
            $table->integer('actor_id')->nullable();
            $table->morphs('statable');
            $table->timestampsTz();
        });
    }
};
