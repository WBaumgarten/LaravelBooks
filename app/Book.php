<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Finds the user that created this book entry.
     *
     * @return object user
     */
    public function user(){
      return $this->belongsTo('App\User');
    }

    /**
     * Finds the user that most recently updated this book entry.
     *
     * @return object user
     */
    public function getUpdater(){
      $user = User::where('id', $this->newest_update_user_id)->first();
      return $user;
    }
}
