<?php

namespace App\Http;

use Carbon\Carbon;
use phpseclib\Crypt\Rijndael;
use phpseclib\Crypt\Base;

class Ktki{

	var $skey 	= ""; // you can change it
	protected $phpseclib = null;
	
	public function setKey($key)
	{
		$this -> skey = $key;
		return $this;
	}
	
    public  function encode($value){ 
		$cryptObject = $this -> getPhpSeclib();
		$cryptObject->setKey($this -> skey);
		return base64_encode($cryptObject->encrypt($value));
    }
    
	protected function getPhpSeclib()
	{
		if($this -> phpseclib === null){
			$this -> phpseclib = new Rijndael(Base::MODE_ECB);
		}
		return $this -> phpseclib;
	}
	
    public function decode($value){
		$cryptObject = $this -> getPhpSeclib();
		$cryptObject->setKey($this -> skey); 
		return $cryptObject->decrypt(base64_decode($value));
    }

}