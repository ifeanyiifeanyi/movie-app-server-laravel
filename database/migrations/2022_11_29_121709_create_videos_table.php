<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('genres_id')->constrained('genres');
            $table->tinyText("short_description");
            $table->text("long_description")->nullable();
            $table->string("length");
            $table->tinyInteger("status");
            $table->string("video");
            $table->string("thumbnail")->nullable();
            $table->smallInteger('rating_id');
            $table->foreignId('parent_control_id')->constrained('parent_controls');
            $table->softDeletes();
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
        Schema::dropIfExists('videos');
    }
};
