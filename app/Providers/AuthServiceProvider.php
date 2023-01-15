<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // $this->defineGateCategory();
        // $this->defineGateProduct();
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();

        //call method in class PermissionGateAndPolicyAccess
        $permissionGateAndPolicy->setGateAndPolicyAccess();


        // Gate::define('list_category', function ($user) {
        //     return  $user->checkPermissionAccess(config('permissions.access.list_category')); //list-category is key_code
        //     // return $user->checkPermissionAccess('list-category'); //list-category is key_code
        //     //dd($user);
        // });

        // Gate::define('add_category', function ($user) {
        //     return  $user->checkPermissionAccess(config('permissions.access.add_category'));
        // });

        // Gate::define('edit_category', function ($user) {
        //     return  $user->checkPermissionAccess(config('permissions.access.edit_category'));
        // });

        // Gate::define('delete_category', function ($user) {
        //     return  $user->checkPermissionAccess(config('permissions.access.delete_category'));
        // });


        // Gate::define('edit_product', function ($user, $id) {
        //     // dd($id);
        //     // $product = Product::find($id);

        //     // //$user->id là id của user đang login hệ thống, $product->user_id là id của user đã tạo ra product
        //     // if ($user->checkPermissionAccess(config('permissions.access.edit_product')) && $user->id == $product->user_id) {
        //     //     return true;
        //     // }
        //     // return false;
        // });
    }

    // public function defineGateCategory()
    // {
    //     Gate::define('list_category', [CategoryPolicy::class, 'view']);
    //     Gate::define('add_category', [CategoryPolicy::class, 'create']);
    //     Gate::define('edit_category', [CategoryPolicy::class, 'edit']);
    //     Gate::define('delete_category', [CategoryPolicy::class, 'delete']);
    // }

    // public function defineGateProduct()
    // {

    //     Gate::define('edit_product', [ProductPolicy::class, 'edit']);
    // }
}