<?php 

namespace App\Workflow;

class FormView 
{
    public $form;
    public function __construct($syarat, $ext=false)
    {
        $i=0;
        foreach($syarat as $file)
        {
            $this->form.=\Form::hidden('syarat_id['.$i.']', $file->id);
            if($ext){
                if(isset($ext[$i])){
                    $this->form.=self::FormFile($file, $ext[$i],$i);
                }else{
                    $this->form.=self::FormFile($file, null, $i);
                }
                    
            }else{
                $this->form.=self::FormFile($file, null, $i);
            }
            
            $i++;
        }            
    }

    public static function FormFile($data, $ext=false, $i=1){
        $form = "<div class='col-lg-12 col-sm-12 mb-3'>";
        if($ext) {
            $form.= "<p>File Lampiran : <a target='_blank' href='".url('permohonan/download/file-persyaratan',[base64_encode($ext['file'])])."'> ".$data->name."</a>";
            if ($ext['sesuai_tidak'] == 1) {
                $form.= "   <span class='badge badge-pill badge-success'>Sesuai</span>";
            } else if ($ext['sesuai_tidak'] == -1) {
                $form.= "   <span class='badge badge-pill badge-danger'>Tidak Sesuai</span>";
            }
            if($ext['file']){
                $form.=" <a target='_blank' href='".url('permohonan/download/file-persyaratan',[base64_encode($ext['file'])])."' class='btn btn-primary btn-sm float-right'> <i class='fa fa-download'></i> Download</a>";
            }
            $form.="</p>";
        }
        $form.= "</div>";
    
        return $form;
    }

    public static function FormRadio($data){
        $val = explode(",", $data);
        
        $form = "<div class='col-lg-12 col-sm-12'>";
        $form.= "<div class='form-group'>";
            $form.= "<label class='required'>Approve ?</label>";
            foreach($val as $rd){
                $form.= "<div class='custom-controls-stacked'>";
                    $form.= "<label class='custom-control custom-radio'>";
                    $form.= \Form::radio('approve',title_case($rd), null,['class'=>'custom-control-input','required'=>'required']);
                    $form.= "<span class='custom-control-indicator'></span>";
                    $form.= "<span class='custom-control-description'>$rd</span></label>";
                $form.= "</div>";
            }
        $form.= "</div>";
        $form.= "</div>";
    
        return $form;
    }
}