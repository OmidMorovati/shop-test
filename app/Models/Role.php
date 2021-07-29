<?php


namespace App\Models;


use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    public const ADMIN = 'admin';
    public const SELLER = 'seller';
    public const CUSTOMER = 'customer';
}
