<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'name', 'public', 'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function leads()
  {
    return $this->hasMany(Lead::class);
  }

  public function getLeadCountAttribute()
  {
    return $this->leads->count;
  }
}
