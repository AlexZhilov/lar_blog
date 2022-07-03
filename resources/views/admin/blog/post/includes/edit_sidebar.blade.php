@php /** @var $post \App\Models\Blog\BlogPost */ @endphp
@if($post->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->created_at }}" disabled>

            @if( $post->created_at != $post->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->updated_at }}" disabled>
            @endif
        </div>
    </div>

@endif

<div class="card {{ $post->exists ? 'mt-2' : '' }}">
    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>

        @if($post->exists)

            <form action="{{ route('admin.blog.category.destroy', $post->id) }}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCatModal">Удалить</button>
            </form>

            <!-- The Modal -->
            <div class="modal" id="deleteCatModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Удалить категорию <b>"{{ $post->title }}"</b>?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>

                    </div>
                </div>
            </div>

        @endif
    </div>
</div>
