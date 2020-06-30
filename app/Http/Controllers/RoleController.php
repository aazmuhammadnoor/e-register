<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Auth;
use Session;

class RoleController extends Controller
{
	public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    function home()
    {
        $title = "Role / Bidang";
        $role = Role::orderBy('id','asc')->paginate(15);
        $no = $role->firstItem();
        return view('page.role.index',compact('title','role','no'));
    }

    function CariRole($keyword)
    {
        $title = "Role / Bidang";
        $role = Role::where('name','like',"%$keyword%")->paginate(15);
        $no = $role->firstItem();
        return view('page.role.index',compact('title','role','no'));
    }

    public function createRole(){
    	$title = "Role/Bidang Baru";
    	return view('page.role.add',compact('title'));
    }

    public function storeRole(Request $r) {
    	$this->validate($r, [
    		'name'=>'required|unique:roles'
    	]);

    	$rs = new Role;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Role/Bidang Berhasil Disimpan')->success();
    	return redirect('admin/config/roles');
    }


    public function editRole(Role $role) {
    	$title = "Edit Role/Bidang";
    	return view('page.role.edit',compact('title','role'));
    }

    public function updateRole(Request $r, Role $role) {
    	$role->name = $r->name;
    	$role->save();
    	flash('Perubahan Role/Bidang Berhasil Disimpan')->success();
    	return redirect('admin/config/roles');
    }

    public function destroyRole(Role $role) {
    	$role->delete();
    	flash('Role Berhasil Dihapus')->success();
    	return redirect('admin/config/roles');
    }
}
