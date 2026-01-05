<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentUserProvider extends EloquentUserProvider
{
    /**
     * Validate a user against the given credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials($user, array $credentials)
    {
        $plain = $credentials['password'];

        // For students, compare plain text password directly
        if (property_exists($user, 'password')) {
            return $user->password === $plain;
        }

        return false;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $model = $this->newModelQuery()->getModel();

        return $this->newModelQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->newModelQuery()->getModel();

        $retrievedModel = $this->newModelQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();

        if (!$retrievedModel) {
            return null;
        }

        $rememberToken = $retrievedModel->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token) ? $retrievedModel : null;
    }

    /**
     * Update the "remember me" token for the user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken($user, $token)
    {
        // Not implementing remember token for students
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (
            empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))
        ) {
            return null;
        }

        $model = $this->model;

        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}

