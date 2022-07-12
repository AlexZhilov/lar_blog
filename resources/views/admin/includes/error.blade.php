@if ($errors->any())

    <div class="col-12 pt-3">

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>

    @push('script')
        <script>
            $('div.alert').not('.alert-important').delay(5000).fadeOut(550);
        </script>
    @endpush

@endif