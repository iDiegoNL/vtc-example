@props([
    'text',
])

{{-- First escape any code in the var with e: https://laravel.com/docs/8.x/helpers#method-e --}}
{{-- Then convert newlines to <br>s with nl2br --}}
{{-- Then display that data unescaped (it's safe because of the 2nd comment) --}}
{!! nl2br(e($text, "\n")) !!}
