<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\KategoriDinas;
use App\Models\BidangIzin;
use App\Models\SeksiIzin;

class UserController extends Controller
{
	public function __construct() {
        $this->middleware(['auth', 'isAdmin'],['except'=>['ProfileUser','EditProfileUser']]);
    }

    function HomeUser()
    {
    	$user = User::orderBy('id','desc')->paginate(15);
        $no = $user->firstItem();
    	$title = "Data User/Pengguna";
    	return view('page.user.index', compact('title','user','no'));
    }

    function SearchUser($keyword)
    {
    	$user = User::where('name','like',"%$keyword%")
    		->orWhere('email','like',"%$keyword%")
    		->orWhere('username','like',"%keyword%")
    		->paginate(15);
        $no = $user->firstItem();
    	$title = "Pencarian Data User/Pengguna";
    	return view('page.user.index', compact('title','user','no'));
    }

    function AddUser()
    {
    	$roles = Role::all();
    	$title = "Data User/Pengguna Baru";
    	return view('page.user.add', compact('title','roles'));
    }

    function SaveUser(Request $r)
    {
    	$this->validate($r, [
    		'name'=>'required',
    		'email'=>'required|email|unique:users',
    		'username'=>'required|unique:users',
    		'password'=>'required',
    		'roles'=>'required'
    	]);
        
    	$rs = new User;
    	$rs->name = $r->name;
    	$rs->email = $r->email;
    	$rs->username = $r->username;
    	$rs->password = $r->password;

    	$rs->save();
    	$rs->roles()->sync($r->roles);
		flash('User/Pengguna Baru Berhasil Disimpan')->success();
    	return redirect('admin/config/users');
    }

    function EditUser(User $user)
    {
    	$roles = Role::all();
        $kategori_dinas = KategoriDinas::all();
        $bidang_izin = BidangIzin::all();
        $seksi_izin = SeksiIzin::all();
    	$title = "Edit Data User/Pengguna";
    	$ext_role = $user->roles()->get()->pluck('id')->toArray();
    	return view('page.user.edit', compact('title','roles','user','ext_role','kategori_dinas','bidang_izin','seksi_izin'));
    }

    function UpdateUser(Request $r, User $user)
    {
    	$user->name = $r->name;
    	$user->email = $r->email;
    	$user->username = $r->username;
    	if($r->has('password'))
    		$user->password = $r->password;

        if($r->has('kategori_dinas'))
            $user->kategori_dinas = $r->kategori_dinas;
        
        if($r->has('bidang_izin'))
            $user->bidang_izin = $r->bidang_izin;

        if($r->has('seksi_izin'))
            $user->seksi_izin = $r->seksi_izin;

    	$user->save();
    	$user->roles()->sync($r->roles);
		flash('Perubahan Data User/Pengguna Berhasil Disimpan')->success();
    	return redirect('admin/config/users');
    }

    function DeleteUsers(User $user)
    {
		$user->delete();
		flash('Data User/Pengguna Berhasil Dihapus')->warning();
    	return redirect('admin/config/users');
    }

    function ProfileUser(User $user)
    {
    	if($user->id != auth()->user()->id)
    		abort(401);

    	$title = "Profil ".$user->name."";
    	return view('page.user.show', compact('title','user'));
    }

    function EditProfileUser(Request $r)
    {
    	$user = User::findOrFail(auth()->user()->id);
    	$user->name = $r->name;
    	$user->email = $r->email;
    	$user->username = $r->username;
    	if($r->has('password'))
    		$user->password = $r->password;

    	$user->save();
		flash('Perubahan Profile Berhasil Disimpan')->success();
    	return redirect('admin/config/users/'.$user->id.'/show');
    }
}
