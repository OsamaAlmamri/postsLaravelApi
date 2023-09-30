<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query)
    {
        if (isset(request()->seaech) and request()->seaech != "") {
            $search = trim(request()->seaech);
            $query->whereHas('tags', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('slug', 'LIKE', "%$search%");
            })->orWhere('title', 'LIKE', "%$search%");
        }
        if (isset(request()->tag) and request()->tag != "") {
            $tag = trim(request()->tag);
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag)
                    ->orWhere('slug', $tag);
            });
        }
        return $query;
    }


}
