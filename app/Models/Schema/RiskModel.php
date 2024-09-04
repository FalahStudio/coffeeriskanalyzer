<?php

namespace App\Models\Schema;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskModel extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $keyType = 'string';

    protected $table = 'risk';
    protected $fillable = [
        'id',
        'schema_id',
        'risk',
        'data_risk',
    ];

    public function schema()
    {
        return $this->belongsTo(SchemaModel::class, 'schema_id');
    }
}
