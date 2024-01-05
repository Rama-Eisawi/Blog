@props(['post'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                <img class="mw-100 mx-auto rounded-xl" src=" {{ $post->getThumbnailImage() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <x-posts.author :author="$post->author" size="xmp" />
                <span class="text-gray-500 text-xs">. {{ $post->published_at->diffForHumans() }}</span>
                <!--diffForHumans used to show the date like 2 days ago and so on..-->
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{ $post->getExcerpt() }}
            </p>
            <!--Average time to read-->
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                @foreach ($post->categories as $category)
                    <x-badge>
                        {{ $category->title }}
                    </x-badge>
                @endforeach
                <div class="flex items-center space-x-4">
                    <span class="text-gray-500 text-sm">{{ $post->getReadingTime() }} minutes to read</span>
                </div>
                <div>
                    <livewire:like-button :key="'like-' . $post->id" :$post />
                    {{-- is used to help Livewire efficiently update the user interface when dealing with dynamic lists or repeating elements --}}
                </div>
            </div>
        </div>
    </div>
</article>
