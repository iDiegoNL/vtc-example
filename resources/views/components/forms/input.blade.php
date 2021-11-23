@props([
    'name',
    'type' => 'text',
])

<input id="{{ $name }}" type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ old($name) }}" {{ $attributes }}>
