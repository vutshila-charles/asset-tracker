<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Inspection extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'inspector_name',
        'passed',
        'notes'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
