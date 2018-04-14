<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;

class UserActivation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_activation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
