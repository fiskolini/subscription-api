<?php

namespace Barkyn\Domain\Entities\Customer;

use Barkyn\Domain\Entities\User\UserEntity;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerEntity
 *
 * @property int            $discount
 * @property int            $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property ?UserEntity    $user
 */
class CustomerEntity extends Model
{
    use Timestamp, SoftDeletes;

    /** @var string */
    protected $table = 'customers';

    /**
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'discount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(UserEntity::class);
    }
}
