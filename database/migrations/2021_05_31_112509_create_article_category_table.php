<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('article_id')->index();
            $table->unsignedBigInteger('category_id')->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_category');
    }
}
