<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * user belongs to user User
     *
     * @return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
