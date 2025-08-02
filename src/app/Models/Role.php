<?php

namespace App\Models;

use App\Observers\RoleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as BaseRole;

#[ObservedBy([RoleObserver::class])]
class Role extends BaseRole
{
    use SoftDeletes, LogsActivity;

    protected $appends = [
        'created_at_formatted',
        'updated_at_formatted',
        'deleted_at_formatted',
    ];

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

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

    public function getDeletedAtFormattedAttribute()
    {
        return $this->deleted_at !== null
            ? $this->deleted_at->diffForHumans()
            : null;
    }
}
