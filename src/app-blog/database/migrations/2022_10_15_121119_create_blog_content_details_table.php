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
        Schema::create('blog_content_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id')->comment('Reference to blog_contents');
            $table->boolean('status')->default(true)->comment('Flag to check the status of the content');
            $table->unsignedBigInteger('detailable_id');
            $table->string('detailable_type');
            $table->foreign('content_id')->references('id')->on('blog_contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_content_details');
    }
};
