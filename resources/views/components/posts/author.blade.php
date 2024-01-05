@props(['author', 'size'])
@php
    $imageSize = match ($size ?? null) {
        'xm' => 'w-7 h-7',
        'sm' => 'w-9 h-9',
        'md' => 'w-10 h-10',
        'lg' => 'w-14 h-14',
        default => 'w-10 h-10',
    };
    $textSize = match ($size ?? null) {
        'xm' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        default => 'text-base',
    };
@endphp
<img class="rounded-full mr-3 {{ $imageSize }}" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}">
<span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>
