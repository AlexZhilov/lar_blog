<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->index('blog_post_category_idx');
            $table->unsignedBigInteger('user_id')->index('blog_post_user_idx');

            $table->string('slug')->unique();
            $table->string('title');

            $table->text('excerpt')->nullable();

            $table->text('content')->nullable();

            $table->string('image')->nullable();

            $table->boolean('is_published')->default(false);

            $table->timestamp('published_at')->nullable()->index('published_at');

            $table->unsignedBigInteger('views')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
