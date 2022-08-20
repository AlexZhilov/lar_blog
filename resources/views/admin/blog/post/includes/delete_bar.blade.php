@php /** @var $post \App\Models\Blog\Post */ @endphp

@if($post->exists)

    <div class="col-md-8">
        <div class="card mt-2">
            <div class="card-body text-right">
                <form action="{{ route('admin.blog.post.destroy', $post->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal">Удалить</button>
                    @include('admin.includes.modal', [
                        'modal_id' => 'deletePostModal',
                        'modal_body' => "Удалить пост <b>{$post->title}</b>?",
                    ])
                </form>
            </div>
        </div>
    </div>

@endif