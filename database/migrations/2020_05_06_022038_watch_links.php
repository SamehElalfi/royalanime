<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WatchLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link');
            $table->string('name')->nullable();
            $table->string('quality')->nullable();
            $table->smallInteger('size')->nullable(); // Episode Size in Megabytes (MB)
            $table->boolean('working')->default(1);
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
        //
    }
}
