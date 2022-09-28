<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'comments';
    protected $appends = [
        'time_comment' => '',
    ];
    public function commentable()
    {
        return $this->morphTo();
    }
    public function setCommentContentAttribute($value)
    {
        return $this->attributes['comment_content'] = ucwords($value);
    }
    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    public function getUpdatedAtAttribute()
    {
        return $this->uppdated_at;
    }
    public function getDiffTimeOfComment()
    {
        return config('timeVarConst.time_now')->diffForHumans($this->getUpdatedAtAttribute());
    }
    public function getTimeCommentAttribute()
    {
        return $this->getDiffTimeOfComment();
    }
    public function setTimeCommentAttribute(){
        $this->attributes['time_comment'] = $this->getTimeCommentAttribute();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
