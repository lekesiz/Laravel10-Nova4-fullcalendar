<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Nova\Actions\ActionEvent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'tracking_number',
        'name',
        'email',
        'password',
        'last_name',
        'username',
        'color',
        'mobile',
        'is_active',
        'role_id',
        'addresse',
        'avatar',
        'is_admin',
        'last_login',
        'note',
        'nir'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function log() {
        return $this->hasMany(ActionEvent::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    public function hasRole($roleName): bool {
        return $this->role && $this->role->name === $roleName;
    }

    public function hasPermission($permissionName): bool {
        return $this->role && $this->role->permissions->contains('name', $permissionName);

        
        // Eğer roles ve permissions ilişkileri yüklenmemişse, yükleyin
        //$this->loadMissing(['roles.permissions']);

        // yukaridaki kod calismazsa alternatif olarak bu kullanilabilir.
        //return $this->role->flatMap(function ($role) {
        //  return $role->permission;
        //})->contains('name', $permissionName);
    }

    public function updateLastActivity()
    {
        $this->last_activity = Carbon::now();
        $this->save();
    }
}
