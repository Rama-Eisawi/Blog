<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class PostList extends Component
{
    use WithPagination;

    //it will add the type of sort to the url
    #[Url]
    public $sort = 'desc';
    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    public function setSort($sort)
    {
        $this->sort = $sort === 'desc' ? 'desc' : 'asc';
    }

    //to listen for search envent
    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed]
    public function posts()
    {
        return Post::published()
            ->orderBy('published_at', $this->sort)
            //To filter by any category
             ->when(Category::where('slug', $this->category)->first(), function ($query) {
                $query->WithCategory($this->category);
            })
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(3); //paginate will show only 3 posts in one page
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
