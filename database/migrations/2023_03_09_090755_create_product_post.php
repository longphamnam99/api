<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_post', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('introduce')->nullable();
            $table->string('code')->nullable();
            $table->string('photo')->nullable();
            $table->string('icon')->nullable();
            $table->string('video')->nullable();
            $table->double('price', 10, 2)->default(0);
            $table->double('preprice', 10, 2)->default(0);
            $table->text('content')->nullable();
            $table->text('user_guide')->nullable();
            $table->string('properties')->nullable();
            $table->string('product_banner')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->boolean("status")->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('viewed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_post');
    }
}
