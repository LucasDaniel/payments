<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateTransfer extends Model
{
    use HasFactory;

    protected $table = 'state_transfers';

    protected $fillable = [
        'state'
    ];
}
