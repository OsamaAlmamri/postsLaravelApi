<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];


    public function scopeFindForLogin(
        Builder $builder,
        string $identifier,
        ?string $mobile_code
    ): Builder {

        return $builder->whereNotNull(columns: 'password')
            ->where(column: function (Builder $builder) use ($identifier) {
                $builder->whereNotNull(columns: 'email')
                    ->where(column: 'email', operator: '=', value: $identifier);
            })
            ->orWhere(column: function (Builder $builder) use ($identifier) {
                $builder->whereNotNull(columns: 'username')
                    ->where(column: 'username', operator: '=', value: $identifier);
            })
            ->orWhere(column: function (Builder $builder) use ($mobile) {
                if (isset($mobile)) {
                    $builder->whereNotNull(columns: 'mobile')
                        ->where(column: 'mobile', operator: '=', value: $mobile);
                }
            });
    }
}
