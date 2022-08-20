@php /** @var $category \App\Models\Blog\Category */ @endphp
@if($category->exists)

    <div class="col-8">
        <div class="card mt-2">
            <div class="card-body text-right">
                <form action="{{ route('admin.blog.category.destroy', $category->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCatModal">Удалить</button>
                    @include('admin.includes.modal', [
                        'modal_id' => 'deleteCatModal',
                        'modal_body' => "Удалить категорию <b>{$category->title}</b>?",
                    ])
                </form>
            </div>
        </div>
    </div>

@endif