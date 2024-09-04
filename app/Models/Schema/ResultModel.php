<?php

namespace App\Models\Schema;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $keyType = 'string';

    protected $table = 'result';
    protected $fillable = [
        'id',
        'schema_id',
        'key',
        'value',
    ];

    public function schema()
    {
        return $this->belongsTo(SchemaModel::class, 'schema_id');
    }
}
