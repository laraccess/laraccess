<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'campaign_id', 'name', 'email', 'url',
  ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
