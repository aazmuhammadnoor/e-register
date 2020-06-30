<?php 

namespace App\Workflow;

class FormPersyaratan
{
    public $form;
    public function __construct($syarat, $action, $executor, $ext=false)
    {
        if(!empty($action))
        {
            $this->form.=\Form::open(['url'=>$action,'files'=>true,'class'=>'card']);
            $this->form.="<div class='card-body row'>";
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

            $this->form.="</div>";
            $this->form.="<footer class='card-footer text-left'>
                <button type='submit' class='btn btn-primary'>Upload Dan Proses</button>";
            if($executor != 'online'){
                $this->form.="<a href='javascript:history.back()' class='btn btn-warning'>Kembali</a>";
            }
            $this->form.="</footer>";
            $this->form.=\Form::close();
        } else {
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
    }

    public static function FormFile($data, $ext=false, $i=1){
        $form = "<div class='col-lg-12 col-sm-12'>";
        if($ext) {
            $form.= "<p>File Sebelumnya : <a target='_blank' href='".url('permohonan/download/file-persyaratan',[base64_encode($ext)])."'> ".$data->name."</a>";
            $form.="</p>";
        }

        $form.= "<div class='input-group form-type-combine file-group'>";
            $form.= "<div class='input-group-input'>";
                $form.= "<label>".$data->name."</label>";
                $form.= \Form::text("syarat_value[$i]",($ext) ? $ext : "", ['class'=>'form-control file-value text-info','required']);
                $form.= \Form::file('syarat['.$i.']');
            $form.= "</div>";
            $form.= '<span class="input-group-btn"><button class="btn btn-danger file-browser" type="button"><i class="fa fa-upload"></i> Upload</button></span>';
        $form.= "</div>";
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
