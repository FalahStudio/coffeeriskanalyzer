<?php

namespace App\Models\Schema;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemaModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';

    protected $table = 'schema';
    protected $fillable = [
        'id',
        'user_id',
        'end_date',
        'status',
    ];

    public function userCredential()
    {
        return $this->belongsTo(UserCredentialModel::class, 'user_id');
    }
}
