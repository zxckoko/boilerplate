<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends BasePermission
{
    use SoftDeletes;

    protected $appends = ['created_at_formatted', 'updated_at_formatted'];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleted_by()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
}
