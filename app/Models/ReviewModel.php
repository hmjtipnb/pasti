<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'role',
        'review',
        'ip_address',
        'created_at',
    ];

    protected $useTimestamps = false;
}

