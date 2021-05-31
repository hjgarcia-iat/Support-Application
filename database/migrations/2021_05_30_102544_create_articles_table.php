<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name')->index();
            $table->string('slug')->unique()->index();
            $table->mediumText('content');
            $table->unsignedInteger('views')->index()->default(0);
            $table->boolean('pinned');
            $table->enum('rating', [0, 1, 2, 3, 4, 5])->index()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
