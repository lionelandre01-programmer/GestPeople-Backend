<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'genero',
        'morada',
        'nascimento',
        'departamento_id',
        'funcao_id',
        'email',
        'password',
        'image',
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

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }

    public function funcao(): BelongsTo
    {
        return $this->belongsTo(Funcao::class, 'funcao_id', 'id');
    }

    public function desempenho(): HasMany
    {
        return $this->hasMany(Desempenho::class);
    }

    public function ultDesempenho(): HasOne
    {
        return $this->hasOne(Desempenho::class)->latestOfMany();
    }

    public function presenca(): HasMany
    {
        return $this->hasMany(Presenca::class);
    }

    public function suspensao(): HasMany
    {
        return $this->hasMany(Suspensao::class);
    }

    public function ultSuspensao(): HasOne
    {
        return $this->hasOne(Suspensao::class)->latestOfMany();
    }

    public function movimento(): HasMany
    {
        return $this->hasMany(Movimento::class);
    }

    public function messege(): HasMany
    {
        return $this->hasMany(Messege::class);
    }

}
