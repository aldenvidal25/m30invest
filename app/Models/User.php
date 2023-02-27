<?php

namespace App\Models;

use App\Enums\TxnStatus;
use App\Enums\TxnType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];
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

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function totalInvestment()
    {
        return $this->transaction()->where('status', TxnStatus::Success)->where(function ($query) {
            $query->where('type', TxnType::Investment);
        })->sum('invest_amount');
    }

    public function totalWithdraw()
    {
        return $this->transaction()->where('status', TxnStatus::Success)->where(function ($query) {
            $query->where('type', TxnType::Withdraw);
        })->sum('invest_amount');
    }
}
