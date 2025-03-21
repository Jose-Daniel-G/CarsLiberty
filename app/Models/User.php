<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles; //añadida no especificada en el curso
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles; //añadida no especificada en el curso
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $fillable = ['name', 'email', 'password',];


    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',];


    protected $casts = ['email_verified_at' => 'datetime',];

    // ADMINLTE
    protected $appends = [
        'profile_photo_url',
    ];
    public function adminlte_image()
    {
        // return auth()->user()->profile_photo_url;
        // return url($this->profile_photo_url);
        return asset('storage/' . $this->profile_photo_path);
        // return 'https://picsum.photos/300/300';
    }
    public function adminlte_desc()
    {
        return $this->roles->pluck('name')->implode(', ');
        // return 'Administrador';
    }
    public function adminlte_profile_url()
    {
        return url('user/profile');
    }
    // Relacion Uno a Muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class);
    }
    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
    public function profesor()
    {
        return $this->hasOne(Profesor::class);
    }

    public function curso()
    {
        return $this->hasOne(Curso::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    // En el modelo User
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
