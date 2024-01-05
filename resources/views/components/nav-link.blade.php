@props(['active','navigate'])

@php
    $classes = $active ?? false ? 'inline-flex items-center hover:text-cyan-900 text-sm text-cyan-500' : 'inline-flex items-center hover:text-cyan-900 text-sm text-gray-500';
@endphp

<a {{ $navigate ?? true ? 'wire:navigate' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    <!--it is changinging the page without any page reloads-->
    {{ $slot }}
</a>
