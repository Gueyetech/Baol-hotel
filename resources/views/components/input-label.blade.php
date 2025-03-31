@props(['value'])

<label {{ $attributes->merge(['class' => 'duration-300  text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
