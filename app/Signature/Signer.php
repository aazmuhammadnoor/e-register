<?php
namespace App\Signature;
use setasign\Fpdi\TcpdfFpdi;
use phpseclib;

class Signer implements SignatureInterface
{
    private $_password;
    private $_pdf;
    private $_privatekey;
    private $_x509Certificate;

    public function setPDF($file)
    {
        if (is_file($file)) {
            $this->_pdf = $file;
        } else {
            exit('The file does not exist');
        }
    }

    public function setPrivateKey($file, $password = null)
    {
        if (is_file($file)) {
            $this->_privatekey = $file;
            if ($password) {
                $this->_password = $password;
            }
        } else {
            exit('The file does not exist');
        }
    }

    public function setX509Certificate($file)
    {
        if (is_file($file)) {
            $this->_x509Certificate = $file;
        } else {
            exit('The file does not exist');
        }
    }
    public function sign($dest, $info = null, $image = null)
    {
        $pdf = new TcpdfFpdi();
        $pdf->setPrintHeader(false);
        $certificate = 'file://' . @realpath(dirname(FILE)) . '/' . $this->_x509Certificate;
        $private = 'file://' . @realpath(dirname(FILE)) . '/' . $this->_privatekey;
        $pageCount = $pdf->setSourceFile($this->_pdf);
        for ($i = 1; $i <= $pageCount; $i++) {
            $tplidx = $pdf->importPage($i);
            $pdf->addPage();
            $pdf->useTemplate($tplidx);
        }
        $pdf->setSignature($certificate, $private, $this->_password, '', 2, $info);
        if (is_file($image)) {
            $pdf->Image($image, 167, 180, 25, 25, 'PNG');
        }
        $pdf->setSignatureAppearance(180, 90, 15, 15);
        $pdf->Output($dest, 'F');
    }
}
