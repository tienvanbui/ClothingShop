<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $shortBlogContents  = null;
    protected $table = 'blogs';
    protected $fillable = [
        'user_id',
        'blog_content',
        'blog_name',
        'thumbnail',
        'outdate',
        // 'viewed_count_number'
    ];
    protected $appends = [
        'short_introduction' => '',
    ];
    public function setBlogNameAttribute($value)
    {
        $this->attributes['blog_name'] = ucwords($value);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getShortIntroductionAttribute()
    {
        return  substr($this->attributes['blog_content'], 0, 200);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
