<?php


namespace App\Models;


use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    public const ADD_SELLER = 'add-seller';
    public const ADD_PRODUCTS = 'add-products';
    public const CREATE_PANEL = 'create-panel';
}
