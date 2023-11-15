<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\UserResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'google_id',
        'profile_photo_path',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function carrito()
    // {
    //     return $this->hasMany(Carrito::class, 'user_id');
    // }

    protected $table = 'users';


    public function adminlte_image()
    {
        $profilePhotoPath = $this->profile_photo_path; // Nombre correcto de la columna en tu base de datos

        if ($profilePhotoPath) {
            // Si el usuario tiene una imagen de perfil, devuelve la URL real de la imagen
            return asset('storage/' . $profilePhotoPath);
        } else {
            // Si el usuario no tiene una imagen de perfil, devuelve la URL predeterminada
            return 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg';
        }
    }

    public function adminlte_desc()
    {
        $user = $this;

        $roles = $user->getRoleNames();

        if (count($roles) > 0) {
            return $roles[0]; // Devuelve el primer rol del usuario
        } else {
            return 'Sin Rol';
        }
    }

    public function adminlte_profile_url()
    {
        return 'user/profile';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function isActive()
    {
        return $this->estado === 'activo';
    }

    public function detalleRepartidor()
{
    return $this->hasOne(DetalleRepartidor::class, 'repartidor_id');
}
public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'user_id');
    }

    public function reportesrepartidor()
{
    return $this->hasMany(Reporte::class, 'repartidor_id');
}

public function repartidor()
    {
        return $this->hasOne(DetalleRepartidor::class, 'repartidor_id');
    }
}
