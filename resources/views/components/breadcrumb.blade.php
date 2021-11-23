@props([
    'name',
    'active' => false,
    'href' => '#',
])

<li {{ $attributes->merge(['class' => $active ? 'active' : '']) }}>
    @if($active)
        {{ $name }}
    @else
        <a href="{{ $href }}">{{ $name }}</a>
    @endif
</li>
