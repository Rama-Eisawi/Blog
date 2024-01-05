@props(['post'])
<div {{ $attributes }}>
    <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
        <div>
            <img class="w-full rounded-xl" src="{{ $post->getThumbnailImage() }}">
            <!--to get the images of posts from database-->
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-1">
            @foreach ($post->categories as $category)
            <x-badge>
                {{ $category->title }}
            </x-badge>
        @endforeach
            <p class="text-gray-500 text-sm">{{ $post->published_at }}</p>
        </div>
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}"
            class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
    </div>

</div>
