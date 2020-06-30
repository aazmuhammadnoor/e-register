<?php

namespace App\Workflow;

use App\Models\Permohonan;

trait PerizinanTrait
{
    function GetFormProperty($izin)
    {
        $property = [];
        if(!is_null($izin->metadata))
        {
            $from_db = json_decode($izin->metadata);
            $i=0;
            foreach($from_db->fields as $obj)
            {
                if ($obj != null) {
                    if($from_db->validations[$i]==null){
                        $property[] = [
                            'field'=>$obj,
                            'label'=>str_replace("_", " ", $obj),
                            'tipe'=>$from_db->tipe[$i],
                            'data'=>$from_db->values[$i],
                            'value'=>null,
                            'col'=>'col-lg-'. $from_db->cols[$i]
                        ];
                    }else{
                        $property[] = [
                            'field'=>$obj,
                            'label'=>str_replace("_", " ", $obj),
                            'tipe'=>$from_db->tipe[$i],
                            'data'=>$from_db->values[$i],
                            'validation'=>$from_db->validations[$i],
                            'value'=>null,
                            'col'=>'col-lg-'. $from_db->cols[$i]
                        ];
                    }
                }
                $i++;
            }
        }

        return $property;
    }

    function GetFormPropertyEdit($izin, $edit)
    {
        $property = [];
        if(!is_null($izin->metadata))
        {
            $from_db = json_decode($izin->metadata);
            $from_edit = json_decode($edit->metadata);
            $i=0;

            foreach($from_db->fields as $obj)
            {
                if($from_db->fields[$i] != null){
                    if($from_db->validations[$i]==null){
                        $property[] = [
                            'field'=>$obj,
                            'label'=>str_replace("_", " ", $obj),
                            'tipe'=>$from_db->tipe[$i],
                            'data'=>$from_db->values[$i],
                            'value'=>(isset($from_edit->$obj)) ? $from_edit->$obj : '',
                            'col'=>'col-lg-'. $from_db->cols[$i]
                        ];
                    }else{
                        $property[] = [
                            'field'=>$obj,
                            'label'=>str_replace("_", " ", $obj),
                            'tipe'=>$from_db->tipe[$i],
                            'data'=>$from_db->values[$i],
                            'validation'=>$from_db->validations[$i],
                            'value'=>(isset($from_edit->$obj)) ? $from_edit->$obj : '',
                            'col'=>'col-lg-'. $from_db->cols[$i]
                        ];
                    }
                }
                $i++;
            }
        }

        return $property;
    }

    public function FormValidationWorkflow($izin)
    {
        $property = $this->GetFormProperty($izin);
        $field_to_validate = [
            'id_profil'=>'required'
        ];
        foreach($property as $frm)
        {
            if(isset($frm['validation'])){
                $field_to_validate[$frm['field']] = $frm['validation'];
            }
        }

        return $field_to_validate;
    }

    protected function NomorPendaftaranSementara($executor, $jenis_izin)
    {
        $qry = Permohonan::where('izin', $jenis_izin->id)
                        ->whereYear('tgl_pendaftaran',date('Y'))
                        ->orderBy('no_pendaftaran_sementara','DESC')
                        ->where('no_pendaftaran_sementara','!=','')
                        ->limit(1)
                        ->first();
        if($qry){
            $exp = str_replace('SEM-','', $qry->no_pendaftaran_sementara);
            $exp = explode('.', $exp);
            $no = $exp[0];
        }else{
            $no = 0;
        }
        return "".sprintf('%06d', ($no+1)).".".$jenis_izin->kode.".".date('y');
    }

    protected function NomorPendaftaran($executor,  $jenis_izin)
    {
        $no = Permohonan::where('izin', $jenis_izin->id)
            ->where('no_pendaftaran', '<>', '')
            ->get();
        return sprintf('%06d', ($no->count()+1)).".".$jenis_izin->kode.".".date('y');
    }

    public function MetadataForm($req, $izin)
    {
        if(!is_null($izin->metadata))
        {
            $metadata = json_decode($izin->metadata);
            foreach($req as $key=>$val)
            {
                if(!in_array($key, $metadata->fields)){
                    unset($req[$key]);
                }
            }
        } else {
            foreach($req as $key=>$val)
            {
                unset($req[$key]);
            }
        }

        return $req;
    }

    function Status_Permohonan($txt)
    {
        $status = [
            'pendaftaran'=>'Proses Pendaftaran',
            'verifikasi'=>'Proses Verifikasi',
            'tinjau'=>'Peninjauan Lapangan',
            'rapat.pasca.tinjau'=>'Rapat Pasca Tinjau',
            'draft'=>'Pengetikan Draft Keputusan',
            'retribusi'=>'Menunggu Pembyaran Retribusi',
            'legalisasi'=>'Penandatanganan / Proses Legalisasi',
            'selesai'=>'Pembuatan SK Izin Telah Selesai',
            'diambil'=>'SK Izin Telah Diambil',
            'ditolak'=>'Permohonan Ditolak'
        ];

        return $status[$txt];
    }
}
