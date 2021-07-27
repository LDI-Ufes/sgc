<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BondDocument extends Model
{
    use HasFactory;

    protected $table = 'bond_documents';

    protected $fillable = [
        'original_name',
        'file_data',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function bond()
    {
        return $this->belongsTo(Bond::class, 'bond_id');
    }
}