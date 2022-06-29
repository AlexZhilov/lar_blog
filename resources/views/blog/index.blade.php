@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <table>

                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->published_at }}</td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

@endsection