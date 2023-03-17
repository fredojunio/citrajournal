@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 placeholder-zinc-400',
]) !!}>
