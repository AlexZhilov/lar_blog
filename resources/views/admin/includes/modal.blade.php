<!-- The Modal -->
<div class="modal text-left" id="{{ $modal_id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $modal_title ?? 'Удаление' }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {!! $modal_body !!}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">{{ $modal_btn ?? 'Удалить' }}</button>
            </div>

        </div>
    </div>
</div>