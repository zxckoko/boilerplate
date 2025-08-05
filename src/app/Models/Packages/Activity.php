<?php

namespace App\Models\Packages;

use App\Models\User;
use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity
{
    protected $appends = [
        'created_at_formatted',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
