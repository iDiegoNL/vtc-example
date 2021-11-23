@props([
    'title' => null,
    'type' => 'info',
])

<div class="alert alert-{{ $type }}">
    @if($title)
        {{ $title }}
        <br><br>
    @endif
    {{ $slot }}
</div>
