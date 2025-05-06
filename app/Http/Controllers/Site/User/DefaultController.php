<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Site\BaseController;
use App\Models\Blog\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class DefaultController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('site.user.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function comment()
    {
        $comments = auth()->user()->postsComment;
        return view('site.user.comment', compact('comments'));
    }

    public function like()
    {
        $posts = auth()->user()->postsLiked;
        return view('site.user.like', compact('posts'));
    }

    public function unlike(Post $post)
    {
        auth()->user()->postsLiked()->detach($post->id);
        return back();
    }

    public function post()
    {
        $posts = $this->paginate(auth()->user()->posts, 3);
        return view('site.user.post', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
