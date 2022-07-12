@if(session()->has('flash_notification'))


    <div class="col-12 pt-3 d-none">

        @foreach (session('flash_notification', collect())->toArray() as $message)
            @if ($message['overlay'])
                @include('flash::modal', [
                    'modalClass' => 'flash-modal',
                    'title'      => $message['title'],
                    'body'       => $message['message']
                ])
            @else
                <div class="flash-msg alert
                    alert-{{ $message['level'] }}
                {{ $message['important'] ? 'alert-important' : '' }}"
                     role="alert"
                >
                    @if ($message['important'])
                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-hidden="true"
                        >&times;
                        </button>
                    @endif

                    {!! $message['message'] !!}
                </div>
            @endif
        @endforeach

    </div>

    {{ session()->forget('flash_notification') }}

    @push('script')
        <script>

            $(document).Toasts('create', {
                title: 'Уведомление',
                body: $(".flash-msg").html(),
                class: 'm-5 alert-{{ $message['level'] }}',
                position: 'bottomRight',
                autohide: true,
                delay: 5000,
            });

        </script>
    @endpush

@endif