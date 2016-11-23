<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->string('category')->unique();
            $table->integer('total')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->decimal('original_price',10,2);
            $table->string('url')->nullable();
            $table->string('description');
            $table->string('category')->nullable();
            $table->string('store');
            $table->string('posted_by');
            $table->string('location')->nullable();
            $table->boolean('is_active')->default(1);
            $table->rememberToken();
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
        Schema::drop('categorys');
        Schema::drop('deals');
    }
}
