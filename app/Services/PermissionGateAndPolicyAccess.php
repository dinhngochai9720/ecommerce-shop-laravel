<?php

namespace App\Services;

use App\Policies\CategoryPolicy;
use App\Policies\MenuPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateProduct();
        $this->defineGateMenu();
        $this->defineGateUser();
    }

    public function defineGateCategory()
    {
        Gate::define('list_category', [CategoryPolicy::class, 'view']);
        Gate::define('add_category', [CategoryPolicy::class, 'create']);
        Gate::define('edit_category', [CategoryPolicy::class, 'edit']);
        Gate::define('delete_category', [CategoryPolicy::class, 'delete']);
    }


    public function defineGateProduct()
    {

        Gate::define('list_product', [ProductPolicy::class, 'view']);
        Gate::define('add_product', [ProductPolicy::class, 'create']);
        Gate::define('edit_product', [ProductPolicy::class, 'edit']);
        Gate::define('delete_product', [ProductPolicy::class, 'delete']);
    }

    public function defineGateMenu()
    {

        Gate::define('list_menu', [MenuPolicy::class, 'view']);
        Gate::define('add_menu', [MenuPolicy::class, 'create']);
        Gate::define('edit_menu', [MenuPolicy::class, 'edit']);
        Gate::define('delete_menu', [MenuPolicy::class, 'delete']);
    }


    public function defineGateUser()
    {

        Gate::define('list_user', [UserPolicy::class, 'view']);
        Gate::define('add_user', [UserPolicy::class, 'create']);
        Gate::define('edit_user', [UserPolicy::class, 'edit']);
        Gate::define('delete_user', [UserPolicy::class, 'delete']);
    }
}