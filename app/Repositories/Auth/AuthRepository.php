<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class AuthRepository implements AuthRepositoryInterface
{

    /**
     * Create new user based on signup flow.
     *
     * @param Array $details
     * @return User $user|false
     */
    public function createUser($details)
    {
        $user = new User;
        foreach ($details as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return $user;
    }

    /**
     * Retrive user data by phone number.
     * NB: Phone number is unique
     *
     * @param String $phone
     * @return User $user|false
     */
    public function getUserByPhone($phone)
    {
        $user = User::where('phone', $phone)->first();
        return $user;
    }

    /**
     * Create api token for User.
     * Used Login process.
     *   
     * @param User $user
     * @param String $deviceIdentity
     * @return String $token
     */
    public function createToken(User $user, $deviceIdentity)
    {
        return $user->createToken($deviceIdentity)->plainTextToken;;
    }

    /**
     * Invalidate API access token.
     * Used for logout
     *
     * @param User $user
     * @return Boolean
     */
    public function revokeToken(User $user)
    {
        return $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    }

    /**
     * Invalidate all access token against the user.
     *
     * @param User $user
     * @return Boolean
     */
    public function revokeAllTokens(User $user)
    {
        # TODO code...
    }
}
