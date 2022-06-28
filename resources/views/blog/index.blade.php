<table>

@foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->published_at }}</td>
        </tr>
@endforeach
</table>
