<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
  use HasFactory;

  protected $fillable = ['text', 'is_correct', 'test_id'];

  public function test(): BelongsTo
  {
    return $this->belongsTo(Test::class);
  }
}
