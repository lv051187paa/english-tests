<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'user_id', 'option_id'];
//    protected $with = ['test:question,id', 'option:id,text,is_correct', 'user:id,name,email'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
