<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestGroup extends Model
{
  use HasFactory;

  protected $fillable = ["group_name"];

  public function tests(): HasMany
  {
    return $this->hasMany(Test::class);
  }
}
