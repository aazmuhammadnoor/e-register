<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;

class MenuController extends Controller
{
	public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    function HomeMenu()
    {
    	$title = "Daftar Menu";
    	$menu = Menu::orderBy('id','desc')->paginate(15);
        $no = $menu->firstItem();
    	return view('page.menu.index',compact('title','menu','no'));
    }

    function SearchMenu($keyword)
    {
    	$title = "Pencarian Daftar Menu";
    	$menu = Menu::where('label','like',"%$keyword%")->orderBy('id','desc')->paginate(15);
        $no = $menu->firstItem();
    	return view('page.menu.index',compact('title','menu','no'));
    }

    function AddMenu()
    {
    	$title = "Tambah Menu Baru";
    	$roles = Role::all();
    	$menu = Menu::whereNull('parent')->get();
    	return view('page.menu.add',compact('title','roles','menu'));
    }

    function SaveMenu(Request $r)
    {
    	$this->validate($r, [
    		'label'=>'required',
    		'url'=>'required',
    		'icon'=>'required',
    		'roles'=>'required'
    	]);

    	$rs = new Menu;

    	$rs->label = $r->label;
    	$rs->url = $r->url;
    	$rs->icon = $r->icon;
    	if($r->has('parent'))
    		$rs->parent = $r->parent;

        /*urutan default*/
        $maxUrutan = Menu::max("urutan");
        $rs->urutan = $maxUrutan+1;
        /**/

    	$rs->save();
    	$rs->roles()->sync($r->roles);
		flash('Daftar Menu Baru Berhasil Disimpan')->success();
    	return redirect('admin/config/menu');
    }

    function EditMenu(Menu $menu)
    {
    	$title = "Edit Menu Baru";
    	$roles = Role::all();
    	$menus = Menu::whereNull('parent')->get();
    	$exrole = $menu->roles()->get()->pluck('id')->toArray();
    	return view('page.menu.edit',compact('title','roles','menu','exrole','menus'));
    }

    function UpdateMenu(Request $r, Menu $menu)
    {
    	$menu->label = $r->label;
    	$menu->url = $r->url;
    	$menu->icon = $r->icon;
    	if($r->has('parent'))
    		$menu->parent = $r->parent;
    	$menu->save();
    	$menu->roles()->sync($r->roles);
		flash('Perubahan Menu Berhasil Disimpan')->success();
    	return redirect('config/menu');
    }

    function DeleteMenu(Menu $menu)
    {
		$menu->delete();
		flash('Menu Berhasil Dihapus')->warning();
    	return redirect('config/menu');
    }

    function sort()
    {
        $title = 'Urutkan Menu';
        return view('page.menu.sort',compact('title'));
    }

    public function updateSort(Request $r)
    {
      $this->validate($r,[
        "id" => 'required',
        "order" => 'required'
      ]);

      $this_menu = Menu::where("id",$r->id)->first();
      $count_menu = Menu::count();

      if($this_menu->urutan == 1){ /*if menu current position is 1*/

        $replacedMenu = Menu::where("urutan","<=",$r->order)
                            ->where("id","!=",$r->id)
                            ->get();
        $new_urutan = 0;
        foreach ($replacedMenu as $row) {
            $menu = Menu::where("id",$row->id)->first();
            $menu->urutan = $new_urutan+1;
            $menu->save();
        }

      }else{ /*if menu current position is not 1*/

        $replacedMenu = Menu::where("urutan",">=",$r->order)
                            ->where("id","!=",$r->id)
                            ->get();
        foreach($replacedMenu as $row){
            $menu = Menu::where("id",$row->id)->first();
            $menu->urutan = ($menu->urutan)+1;
            $menu->save();
        }

      }

      $this_menu->urutan = $r->order;
      $this_menu->save();

    }
}
