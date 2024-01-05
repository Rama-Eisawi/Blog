<div class=" px-3 lg:px-7 py-6">
    <!--Filters-->
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="flex items-center space-x-4 font-light ">
            <button
                class="{{ $sort === 'desc' ? 'text-gray-900 py-4 border-b border-gray-700' : 'text-gray-500' }}"wire:click="setSort('desc')">Latest</button>
            <button
                class="{{ $sort === 'asc' ? 'text-gray-900 py-4 border-b border-gray-700' : 'text-gray-500' }}
                "wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item :key="$post->id" :post="$post" />
        @endforeach
        <!--Pagination-->
    </div class='my-3'>
    {{ $this->posts->onEachSide(1)->links() }} <!--to show the pagination -->
    <div>
    </div>
</div>
