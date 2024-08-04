<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('post_id')->index('bc_post_idx');
            $table->unsignedBigInteger('user_id')->index('bc_user_idx')->nullable();
            $table->text('message');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->on('blog_comments')->references('id');
            $table->foreign('post_id')->on('blog_posts')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
