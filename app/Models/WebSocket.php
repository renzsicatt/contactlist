<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSocket extends Model
{
    use HasFactory;

    protected $table = 'websocket';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Action',
        'Date'
    ];
}
