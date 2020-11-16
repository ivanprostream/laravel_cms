<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->string('short_text')->nullable();
            $table->text('text')->nullable();
            $table->text('text_2')->nullable();
            $table->string('image')->nullable();
            $table->integer('show')->default(1)->comment('1=show 0=not show');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('key_words')->nullable();
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('type');
            $table->integer('menu')->default(1)->comment('1=show list 0=dont show list');
            $table->text('script')->nullable();

            $table->timestamps();

            $table->foreign('type')->references('id')->on('page_type');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page');
    }
}
