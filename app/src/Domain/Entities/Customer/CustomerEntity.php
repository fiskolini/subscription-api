<?php

namespace Barkyn\Domain\Entities\Customer;

use Barkyn\Domain\Entities\User\UserEntity;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerEntity extends Model
{
    use Timestamp, SoftDeletes;

    /** @var string */
    protected $table = 'customers';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['user_id', 'discount'];

    public function user()
    {
        return $this->belongsTo(UserEntity::class);
    }
}
