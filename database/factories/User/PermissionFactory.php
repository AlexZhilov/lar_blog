<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public static function permissions()
    {
        return [
            ['slug' => 'admin-access', 'name' => 'Доступ к админ-панеле'],

            ['slug' => 'user-manage', 'name' => 'Управление пользователями'],
            ['slug' => 'user-create', 'name' => 'Создание пользователя'],
            ['slug' => 'user-edit', 'name' => 'Редактирование пользователя'],
            ['slug' => 'user-delete', 'name' => 'Удаление пользователя'],

            ['slug' => 'role-manage', 'name' => 'Управление ролями пользователей'],
            ['slug' => 'role-create', 'name' => 'Создание роли пользователя'],
            ['slug' => 'role-edit', 'name' => 'Редактирование роли пользователя'],
            ['slug' => 'role-delete', 'name' => 'Удаление роли пользователя'],

            ['slug' => 'assign-role', 'name' => 'Назначение роли для пользователя'],
            ['slug' => 'assign-permission', 'name' => 'Назначение права для пользователя'],

            ['slug' => 'blog-post-manage', 'name' => 'Управление постами блога'],
            ['slug' => 'blog-post-create', 'name' => 'Создание поста блога'],
            ['slug' => 'blog-post-edit', 'name' => 'Редактирование поста блога'],
            ['slug' => 'blog-post-publish', 'name' => 'Публикация поста блога'],
            ['slug' => 'blog-post-delete', 'name' => 'Удаление поста блога'],

            ['slug' => 'blog-category-manage', 'name' => 'Управление категориями блога'],
            ['slug' => 'blog-category-create', 'name' => 'Создание категории блога'],
            ['slug' => 'blog-category-edit', 'name' => 'Редактирование категории блога'],
            ['slug' => 'blog-category-delete', 'name' => 'Удаление категории блога'],

            ['slug' => 'blog-comment-manage', 'name' => 'Управление комментариями блога'],
            ['slug' => 'blog-comment-create', 'name' => 'Создание комментария к посту'],
            ['slug' => 'blog-comment-edit', 'name' => 'Редактирование комментария к посту'],
            ['slug' => 'blog-comment-publish', 'name' => 'Публикация комментария к посту'],
            ['slug' => 'blog-comment-delete', 'name' => 'Удаление комментария к посту'],

        ];
    }

}
