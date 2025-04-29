<?php

use App\Models\User\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

#### ADMIN ####

Breadcrumbs::register('admin.index', function (Crumbs $crumbs) {
    $crumbs->push('Admin', route('admin.index'));
});

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