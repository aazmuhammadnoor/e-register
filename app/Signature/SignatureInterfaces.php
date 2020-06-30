<?php 
namespace App\Signature;

interface SignatureInterface
{
    public function setPrivateKey($file, $password = null);
    public function setX509Certificate($file);
}