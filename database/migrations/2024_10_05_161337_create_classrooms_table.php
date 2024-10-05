<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('教室名');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_rooms');
    }
}
