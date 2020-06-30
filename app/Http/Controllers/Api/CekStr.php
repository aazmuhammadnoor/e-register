<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CekStr extends Controller
{

  public $username="palembang";
  public $password="PLg91Ax";
  public $url     ="http://registrasi.kki.go.id/index.php/api/";

  protected function getToken(){
    $reqUrl = $this->url."token?username={$this->username}&password={$this->password}";
    $token = file_get_contents($reqUrl);
    return json_decode($token);
  }

  public function getStr(Request $r)
  {
    if(!$r->has('str')){
      return response()->json([
        'status'=>false
      ],200,['Access-Control-Allow-Origin'=>'*']);
    }else{
      $str = $r->str;
    }

    $str = str_replace('.','', $str);
    $str = str_replace('-','', $str);
    $str = str_replace(' ','', $str);

    $token = $this->getToken();
    if($token->status == 'berhasil'){
      $res_token = $token->data->token;
      $dataReq = $this->url."profile?username={$this->username}&token={$res_token}&str={$str}";
      $data = file_get_contents($dataReq);
      $data = json_decode($data);
      return response()->json($data,200,['Access-Control-Allow-Origin'=>'*']);
    }else{
      return response()->json([
        'status'=>false
      ],200,['Access-Control-Allow-Origin'=>'*']);
    }
  }
}
