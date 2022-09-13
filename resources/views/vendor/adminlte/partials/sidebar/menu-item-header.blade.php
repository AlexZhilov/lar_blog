<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-header {{ $item['class'] ?? '' }}">
    <b>{{ is_string($item) ? $item : $item['header'] }}</b>
</li>
