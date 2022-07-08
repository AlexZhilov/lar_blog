@php /** @var $category \App\Models\Blog\Category */ @endphp
@if($category->exists)

    <div class="col-8">
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ route('admin.blog.category.destroy', $category->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCatModal">Удалить</button>

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
                </form>
            </div>
        </div>
    </div>

@endif