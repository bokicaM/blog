<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')();
    }

    public function scopeFilter($query, array $filters)
    {

        if (!empty($filters['sortBy'])) {
            $query->when($filters['sortBy'] === "MostViews", function ($query) {
                return $query->orderBy('view_counter', 'desc');
            })
                ->when($filters['sortBy'] === "oldest", function ($query) {
                    return $query->orderBy('created_at', 'asc');
                })
                ->when($filters['sortBy'] === "newest", function ($query) {
                    return $query->orderBy('created_at', 'desc');
                });
        } else
            $query->orderBy('created_at', 'desc');
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
//                    ->orWhere('excerpt', 'like', '%' . $search . '%')
//                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        }
        if (!empty($filters['category'])) {
            $category = $filters['category'];
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }
    }

// Uvecava broj pregleda
    public function counter(): bool
    {
        $this->view_counter++;
        return $this->save();
    }
}
