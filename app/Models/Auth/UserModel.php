<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';

    protected $table = 'users';
    protected $fillable = [
        'id',
        'email',
        'password',
        'role',
    ];
}
