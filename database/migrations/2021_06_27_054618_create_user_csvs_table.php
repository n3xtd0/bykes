<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCsvsTable extends Migration
{

    public function up()
    {
        Schema::create('user_csvs', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->integer('user_id');
            $table->boolean('is_processed');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('user_csvs');
    }
}
