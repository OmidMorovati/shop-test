<?php


namespace App\Services\Contracts;

/**
 * Interface AuthServiceInterface
 * @package App\Services\Contracts
 */
interface AuthServiceInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function register(string $name, string $email, string $password);

    /**
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function login(string $email, string $password);

    /**
     * @return mixed
     */
    public function me();

    public function logout(): void;
}
