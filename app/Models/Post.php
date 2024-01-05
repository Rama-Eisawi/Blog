<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = ['user_id','title','slug','body','image','published_at','featured'];

    //for the "one to many" relationship between posts table and users table
    public function author()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    //for the "many to many" relationship between posts table and categories table
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class,'post_like');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());//to get only the posts that are already published
    }
//Filter
public function scopeWithCategory($query, string $category)
{
    $query->whereHas('categories', function ($query) use ($category) {
        $query->where('slug', $category);
    });
}

    public function scopeFeatured($query)
    {
        $query->where('featured',true);//to get only the posts that are featured
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body),150);
    }
    public function getReadingTime()
    {
        $minutes= round(str_word_count($this->body)/250); //the average is 250 words in a minute
        if($minutes==0)
        return 1;
    else return $minutes;
    }

    //this code use to deal with both fake images witch contain http.., and the uploaded image from user
    public function getThumbnailImage()
    {
        //check if the string contain any specific word
        $isUrl=str_contains($this->image,'http');
        return ($isUrl)  ? $this->image : Storage::url($this->image);
    }
}
