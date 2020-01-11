<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $table = 'addresses';
    protected $fillable = [
        'user_id',
        'zip_code',
        'state',
        'street',
        'complement',
        'district',
        'number',
        'city',
    ];

    protected $dates = ['created', 'updated', 'deleted'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
