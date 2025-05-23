<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocAccess extends Model
{
    protected $table = 'doc_acccess';
    protected $primaryKey = 'access_id';
    public $timestamps = false;
} 