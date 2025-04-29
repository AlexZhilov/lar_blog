<?php
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push('Home', route('home'));
});

Breadcrumbs::register('blog', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Blog', route('blog'));
});


