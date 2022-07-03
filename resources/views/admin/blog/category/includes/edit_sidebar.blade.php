@php /** @var $category \App\Models\Blog\BlogCategory */ @endphp
@if($category->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $category->created_at }}" disabled>

            @if( $category->created_at != $category->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $category->updated_at }}" disabled>
            @endif
        </div>
    </div>

@endif

<div class="card {{ $category->exists ? 'mt-2' : '' }}">
    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>

        @if($category->exists)

            <form action="{{ route('admin.blog.category.destroy', $category->id) }}">
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
                            Удалить категорию <b>"{{ $category->title }}"</b>?
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
