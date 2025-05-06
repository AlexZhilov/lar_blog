<?php

use App\Models\Blog\{Category, Post, Tag};
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', static function (Crumbs $crumbs) {
    $crumbs->push('Home', route('home'));
});
#############
#### BLOG ####
#############
Breadcrumbs::register('blog', static function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Blog', route('blog'));
});

Breadcrumbs::register('blog.category', static function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('blog');
    $crumbs->push($category->title, route('blog.category', $category));
});

Breadcrumbs::register('blog.post', static function (Crumbs $crumbs,Category $category, Post $post) {
    $crumbs->parent('blog.category', $category);
    $crumbs->push($post->title, route('blog.post', [$category, $post]));
});

Breadcrumbs::register('blog.tag', static function (Crumbs $crumbs, Tag $tag) {
    $crumbs->parent('blog');
    $crumbs->push("Tag :: $tag->title", route('blog.tag', $tag));
});

