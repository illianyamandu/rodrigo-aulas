<?php

namespace App;

enum PermissionName: string
{
    // Product Permissions
    case PRODUCTS_MANAGE = 'products.manage';
    case PRODUCTS_DELETE = 'products.delete';
    case PRODUCTS_LIST = 'products.list';
    case PRODUCTS_CREATE = 'products.create';

    // User Permissions
    case USERS_LIST = 'users.list';
    case USERS_MANAGE = 'users.manage';
}
