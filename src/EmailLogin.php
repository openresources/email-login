<?php

namespace Openresources\EmailLogin;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class EmailLogin extends Model
{
    protected $fillable = ['email', 'token', 'user_id'];

    public static function createForEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        return self::create(
            [
                'email' => $email,
                'token' => Str::random(30),
                'user_id' => $user->id,
            ]
        );
    }

    public function hasVerifiedEmail(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    public function markEmailAsVerified(User $user)
    {
        return $user->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFromToken($query, String $token)
    {
        return $query->where('token', $token)
            ->where('created_at', '>', Carbon::parse('-15 minutes')) ;
    }
}
