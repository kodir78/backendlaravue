<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DashboardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $income = Transaction::where('transaction_status','SUCCESS')->sum('transaction_total');
        $sales = Transaction::count();
        $items = Transaction::with('details')->orderBy('id','DESC')->take(5)->get();
        $pie = [
            'pending' => Transaction::where('transaction_status','PENDING')->count(),
            'failed' => Transaction::where('transaction_status','FAILED')->count(),
            'success' => Transaction::where('transaction_status','SUCCESS')->count(),
        ];

        // Role::create(['name'=>'writer']);
        // Permission::create(['name'=>'edit post']);
        // $permission = Permission::create(['name'=>'write post']);
        // $role = Role::findById(3);
        // $role->givePermissionTo($permission);
        // auth()->user()->givePermissionTo('edit post');
        // auth()->user()->assignRole('writer');
        // return auth()->user()->permissions;
        // return auth()->user()->getDirectPermissions();
        // return auth()->user()->getPermissionsViaRoles();
        // return auth()->user()->getAllPermissions();
        // return User::role('writer')->get(); // Returns only users with the role 'writer'
        // return User::role('admin')->get(); // Returns only users with the role 'writer'
        // return auth()->user()->revokePermissionTo('edit post'); // remove permission
        // return auth()->user()->removeRole('writer'); // remove role
        // return User::role('operator')->get(); // Returns only users with the role 'writer'

        return view('pages.dashboard', compact('income', 'sales', 'items','pie'));

    }
}
