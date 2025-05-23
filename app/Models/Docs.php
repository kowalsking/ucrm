<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Docs extends Model
{
    protected $table = 'docs';
    protected $primaryKey = 'docs_id';
    public $timestamps = false;

    protected $fillable = [
        'docs_hash',
        'docs_name',
        'docs_type_id',
        'docs_status_id',
        'access_id',
        'prioruty_id',
        'absctract',
        'parent_docs_id',
        'deadline',
        'date_created',
        'date_updated'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'date_created' => 'datetime',
        'date_updated' => 'datetime'
    ];

    public function docsType(): BelongsTo
    {
        return $this->belongsTo(DocsType::class, 'docs_type_id', 'docs_type_id');
    }

    public function docsStatus(): BelongsTo
    {
        return $this->belongsTo(DocsStatus::class, 'docs_status_id', 'docs_status_id');
    }

    public function access(): BelongsTo
    {
        return $this->belongsTo(DocAccess::class, 'access_id', 'access_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'prioruty_id', 'priority_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'docs_employee', 'docs_id', 'employee_id')
            ->withPivot('position_id', 'signed');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'docs_files', 'docs_id', 'file_id');
    }
} 