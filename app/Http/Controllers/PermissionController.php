<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;

class PermissionController extends Controller
{
	public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function HomePermission() {
        $title = "Permissions";
        $permissions = Permission::orderBy('id','desc')->paginate(15);
        $no = $permissions->firstItem();
        return view('page.permissions.index',compact('title','permissions','no'));
    }

    function SearchPermission($keyword=null)
    {
        //dd($keyword);
        $title = "Permissions";
        $permissions = Permission::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(15);
        $no = $permissions->firstItem();
        return view('page.permissions.index',compact('title','permissions','no'));
    }

    public function AddPermission(){
    	$title = "Permission Baru";
        $roles = Role::get();
    	return view('page.permissions.add',compact('title','roles'));
    }

    public function SavePermission(Request $r) {
    	$this->validate($r, [
    		'name'=>'required|unique:permissions'
    	]);

    	$rs = new Permission;
    	$rs->name = $r->name;
    	$rs->save();

        $rs->roles()->sync($r->roles);
        $user_has_role  = \App\Models\User::whereHas('roles', function($q) use ($r){
            $q->whereIn('id', $r->roles);
        })->get();
        
        foreach($user_has_role as $usr)
        {
           $perm = $usr->roles()->first()->permissions()->pluck('name')->toArray();
           $usr->syncPermissions($perm);
        }
    	flash('Permission Berhasil Disimpan')->success();
    	return redirect('admin/config/permissions');
    }

    public function EditPermission(Permission $permissions) {
    	$title = "Edit Permission";
        $roles = Role::get();
        $ext_roles = $permissions->roles()->get()->pluck('id')->toArray();
    	return view('page.permissions.edit',compact('title','permissions','roles','ext_roles'));
    }

    public function UpdatePermission(Request $r, Permission $permissions) {
    	$permissions->name = $r->name;
    	$permissions->save();
        $permissions->roles()->sync($r->roles);

        $roles = Role::whereIn('id', $r->roles)->get();
        foreach($roles as $rl){
            $perm = $rl->permissions()->pluck('name')->toArray();
            $usr = $rl->users()->get();
            foreach($usr as $orang){
               $orang->permissions()->detach();
               $orang->syncPermissions($perm);
            }
        }

    	flash('Perubahan Permission Berhasil Disimpan')->success();
        return redirect('admin/config/permissions');
    }

    public function DeletePermission(Permission $permissions) {
    	$permissions->delete();
    	flash('Permission Berhasil Dihapus')->success();
    	//return redirect()->back();
        return redirect('admin/config/permissions');
    }
}
