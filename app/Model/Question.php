<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Str;
class Question extends Model
{
    //

    protected static function boot(){
        parent::boot();
        static::creating(function($question){
            $question->slug = Str::slug($question->title);
        });
    }
    // protected $guarded = [];
    protected $fillable = ['title','body','user_id','category_id','slug'];
    protected $with = ['replies'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class)->latest();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getPathAttribute(){
        return "/question/$this->slug";
    }

    
}
