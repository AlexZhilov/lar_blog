<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostUserLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_user_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('bpul_user_idx');
            $table->unsignedBigInteger('post_id')->index('bpul_post_idx');

            $table->foreign('post_id', 'bpul_post_fk')->on('blog_posts')->references('id');
            $table->foreign('user_id', 'bpul_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_user_likes');
    }
}
