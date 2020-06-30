<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class Userauth extends Controller {

  public function Auth(Request $r){
      $this->validate($r,[
        'username'=>'required',
        'password'=>'required'
      ]);

      $user = User::where('username', $r->username)->with(['getBidangIzin','getSeksiIzin'])->first();
      if (password_verify($r->password, $user->password)) {
          $user->hasAnyRole(\App\Models\Role::all());
          $allowed_role = [3,10,11];
          if(in_array($user->roles[0]['id'], $allowed_role)){
            $bidang = ($user->getBidangIzin) ? $user->getBidangIzin->nama : '';
            $seksi  = ($user->getSeksiIzin) ? $user->getSeksiIzin->nama : '';

            $sukses = [
              'nama'=>$user->name,
              'id'=>$user->id,
              'kategori_dinas'=>$user->kategori_dinas,
              'bidang_izin'=>$user->bidang_izin,
              'seksi_izin'=>$user->seksi_izin,
              'email'=>$user->email,
              'username'=>$user->username,
              'role_id'=>$user->roles[0]['id'],
              'role_name'=>$user->roles[0]['name'],
              'bidang'=>$bidang,
              'seksi'=>$seksi
            ];
            return response()->json(['status'=>true,'data'=>$sukses]);
          }else{
            return response()->json(['status'=>false,'msg'=>'Maaf, anda tidak berhak login dalam aplikasi ini']);
          }
      }else{
        return response()->json(['status'=>false,'msg'=>'User tidak ditemukan']);
      }
  }

}
