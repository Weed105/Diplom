<?php

namespace App;

use App\Scopes\AnswerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    public $table = 'answers';

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'answer',
        'score',
    ];


    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AnswerScope);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
