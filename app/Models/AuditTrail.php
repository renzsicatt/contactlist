<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $table = 'audittrail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Action',
        'Date'
    ];
}
