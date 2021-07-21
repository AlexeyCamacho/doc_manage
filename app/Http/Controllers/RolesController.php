<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\Permission;
use App\Rules\alpha_spaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{

    public $items = [
        'users' => 'Пользователи', 
        'permissions' => 'Права',
        'roles' => 'Роли'
    ];

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    } 

    public function index() {   
        if (!Gate::allows('views-roles')) {
            return view('PermError');
        }
        return view('role.role', ['roles' => Role::paginate(10)]);
    }

    protected function get_all_permissions() {
        $permission = [];

        foreach($this->items as $key => $value)
        {
            $permission[$value] = (Permission::where('slug', 'LIKE', '%' . $key)->get());
        }

        return $permission;
    }

    public function show_create() {

        if (!Gate::allows('create-roles')) {
            return view('PermError');
        }

        $permission = self::get_all_permissions();

        return view('role.create', ['permissionСategories' => $permission]);
    }

    public function create(Request $req) {

        if (!Gate::allows('create-roles')) {
            return abort(403, 'Нет прав');
        }

        $validation = $req->validate([
            'title' => ['required', 'min:5','string','unique:roles,name', new alpha_spaces],
            'slug' => ['required', 'min:5', 'string','unique:roles,slug',new alpha_spaces]
        ]);

        Role::create([
            'name' => $req->title,
            'slug' => $req->slug, 
        ]);

        $reqPermissions = $req->except('slug', 'title', '_token');

        foreach($reqPermissions as $key => $value)
        {
            $permissions[] = $value;
        }

        $role = Role::where('slug', $req->slug)->first();
        $permissions = Permission::whereIn('slug', $permissions)->get();

        $role->permissions()->attach($permissions);

    }

    public function delete(Request $req) {

        if (!Gate::allows('delete-roles')) {
            return abort(403, 'Нет прав');
        }

        Role::destroy($req->id);
    }

    public function show_edit() {

        if (!Gate::allows('edit-roles')) {
            return view('PermError');
        }

        $route = \Route::current();
        $id = $route->parameter('id') ?: null;

        $role = Role::where('id', $id)->first();

        if ($id == null || $role == null) { return redirect()->route('role'); }

        $permission = self::get_all_permissions();

        return view('role.edit', ['role' => $role, 'permissionСategories' => $permission]);
    }
}
