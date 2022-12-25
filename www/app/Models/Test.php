<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['question'];
    protected $with = ['options:id,text,is_correct,test_id'];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}
