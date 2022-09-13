<?php

namespace App\Observers\User;

use App\Models\User\User;

class UserObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        flash("Пользователь '{$user->name}' создан.")->success();
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        flash("Пользователь '{$user->name}' обновлен.")->success();
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        flash("Пользователь '{$user->name}' удален.");
    }
}
