<?php

namespace Barkyn\Domain\Entities\User;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEntity extends Model
{
    use Timestamp, SoftDeletes;

    /** @var string */
    protected $table = 'users';

    /** @var string[] */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /** @var string[] */
    protected $fillable = ['email', 'firstname', 'lastname',];
}
