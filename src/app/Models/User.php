<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, LogsActivity, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'created_at_formatted',
        'updated_at_formatted',
        'deleted_at_formatted',
    ];

    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'address_1', 'address_2'])
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
