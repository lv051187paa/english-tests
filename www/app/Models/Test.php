<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Test extends Model
{
  use HasFactory;

  protected $fillable = ['question'];
  protected $with = ['options:id,text,is_correct,test_id'];

  public function options(): HasMany
  {
    return $this->hasMany(Option::class);
  }

  public function testGroup(): BelongsTo
  {
    return $this->belongsTo(TestGroup::class);
  }
}
