@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1 my-2 text-md font-bold leading-5 rounded-lg font-bold bg-[#e5e3a3] text-black transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-1 my-2 text-md font-bold leading-5 rounded-lg font-bold text-black hover:bg-[#e5e3a3]   transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
