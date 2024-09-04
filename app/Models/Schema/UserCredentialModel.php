<?php

namespace App\Models\Schema;

use App\Models\Auth\UserModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredentialModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';

    protected $table = 'user_credential';
    protected $fillable = [
        'id',
        'user_id_one',
        'user_id_two',
        'user_id_three',
    ];

    public function userOne()
    {
        return $this->belongsTo(UserModel::class, 'user_id_one');
    }

    public function userTwo()
    {
        return $this->belongsTo(UserModel::class, 'user_id_two');
    }

    public function userThree()
    {
        return $this->belongsTo(UserModel::class, 'user_id_three');
    }
}
