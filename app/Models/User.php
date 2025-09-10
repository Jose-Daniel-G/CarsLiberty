<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;  
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable implements MustVerifyEmail //AL MOMENTO DE UN USUARIO NUEVO INICIAR SESSION LE PEDIRIA VALIDAR EL CORREO
class User extends Authenticatable // AQUI ESTA DESACTIVADO
{
    use HasRoles;  
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $fillable = ['name', 'email', 'password',];

    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',];

    protected $casts = ['email_verified_at' => 'datetime',];

    protected $appends = ['profile_photo_url',];// ADMINLTE

    public function adminlte_image() // return auth()->user()->profile_photo_url;// return url($this->profile_photo_url);
    {  return url($this->profile_photo_url); // return asset('storage/' . $this->profile_photo_path);
         }

    public function adminlte_desc(){   return $this->roles->pluck('name')->implode(', ');   } // return 'Administrador';
    public function adminlte_profile_url()
    {
        return url('user/profile');
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
        return $this->hasOne(Profesor::class, 'user_id');
    }
    public function curso()
    {
        return $this->hasOne(Curso::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function horarios()// En el modelo User
    {
        return $this->hasMany(Horario::class);
    }
}
