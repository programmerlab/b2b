<?php

namespace Ribrit\Tenant\Database\Models\Note;

use Illuminate\Database\Eloquent\SoftDeletes;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Note extends Model
{
    use TenantRelationTrait, GroupRelationTrait, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'note';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'process_id',
        'user_id',
        'path_title',
        'path',
        'author',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}