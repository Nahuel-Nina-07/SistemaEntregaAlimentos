<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'rol',
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
        $rol = $this->rol;

        switch ($rol) {
            case 0:
                return 'Usuario';
            case 1:
                return 'Repartidor';
            case 2:
                return 'Administrador';
            default:
                return 'Rol Desconocido';
        }
    }

    public function adminlte_profile_url()
    {
        return 'user/profile';
    }
}
