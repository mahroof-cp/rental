<?php

namespace App\Repositories\Auth;

use App\Models\User;

interface AuthRepositoryInterface
{

    /**
     * Create new user based on signup flow.
     *
     * @param Array $request
     * @return User $user|false
     */
    public function createUser($details);


    /**
     * Retrive user data by phone number.
     * NB: Phone number is unique
     *
     * @param String $phone
     * @return User $user|false
     */
    public function getUserByPhone($phone);

    /**
     * Create api token for User.
     * Used Login process.
     *   
     * @param User $user
     * @param String $deviceIdentity
     * @return String $token
     */
    public function createToken(User $user, $deviceIdentity);

    /**
     * Invalidate API access token.
     * Used for logout
     *
     * @param User $user
     * @return Boolean
     */
    public function revokeToken(User $user);

    /**
     * Invalidate all access token against the user.
     *
     * @param User $user
     * @return Boolean
     */
    public function revokeAllTokens(User $user);
  
}
