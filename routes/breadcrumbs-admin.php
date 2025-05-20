<?php

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
###############
#### ADMIN ####
##############

Breadcrumbs::register('admin.index', function (Crumbs $crumbs) {
    $crumbs->push('Admin', route('admin.index'));
});

#### USERS ####

Breadcrumbs::register('admin.user.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.index');
    $crumbs->push('Users', route('admin.user.index'));
});

Breadcrumbs::register('admin.user.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.user.index');
    $crumbs->push('Create user', route('admin.user.create'));
});

Breadcrumbs::register('admin.user.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.user.index');
    $crumbs->push($user->name, route('admin.user.edit', $user));
});

#### BLOG POST ####

Breadcrumbs::register('admin.blog.post.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.index');
    $crumbs->push('Posts', route('admin.blog.post.index'));
});

Breadcrumbs::register('admin.blog.post.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.blog.post.index');
    $crumbs->push('Create post', route('admin.blog.post.create'));
});

Breadcrumbs::register('admin.blog.post.edit', function (Crumbs $crumbs, Post $admin_post) {
    $crumbs->parent('admin.blog.post.index');
    $crumbs->push($admin_post->title, route('admin.blog.post.edit', $admin_post));
});

#### BLOG CATEGORY ####

Breadcrumbs::register('admin.blog.category.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.index');
    $crumbs->push('Categories', route('admin.blog.category.index'));
});

Breadcrumbs::register('admin.blog.category.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.blog.category.index');
    $crumbs->push('Create category', route('admin.blog.category.create'));
});

Breadcrumbs::register('admin.blog.category.edit', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.blog.category.index');
    $crumbs->push($category->title, route('admin.blog.category.edit', $category));
});