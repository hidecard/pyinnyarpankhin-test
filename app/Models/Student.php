<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'student_list';

    protected $fillable = [
        'student_name',
        'student_id',
        'photo',
        'dob',
        'father_name',
        'phone_number',
        'email_address',
        'address',
        'username',
        'password',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->username;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Check if the given password matches the stored password.
     * This method overrides Laravel's default bcrypt comparison
     * to work with plain text passwords stored for students.
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * Get the remember token for the user.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * Set the remember token for the user.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Not implementing remember token for students
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return null;
    }
}
