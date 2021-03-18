<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContacts extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('reason');
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('district');
            $table->string('subject');
            $table->string('details');
            $table->boolean('email_processed')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}