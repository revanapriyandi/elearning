<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * @var array
     */
    protected $appends = ['image_url'];

    public function pengajar()
    {
        return $this->hasOne(Pengajar::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function ImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->defaultImageUrl();
        });
    }

    protected function defaultImageUrl()
    {
        $nama_lengkap = trim(collect(explode(' ', $this->nama_lengkap))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($nama_lengkap) . '&color=7F9CF5&background=EBF4FF';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPengajar()
    {
        return $this->role === 'pengajar';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}
