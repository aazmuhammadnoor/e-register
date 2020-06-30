<?php

namespace App\Workflow;

class FormPermohonan
{
    public $form;

    public function __construct($data)
    {
        if(is_array($data))
        {
            foreach($data as $frm)
            {
                if($frm['field']!=null)
                {
                    if($frm['tipe'] == 'text')
                    {
                        $this->form.=self::FormText($frm);
                    }

                    if($frm['tipe'] == 'textarea'){
                        $this->form.=self::FormTextarea($frm);
                    }

                    if($frm['tipe'] == 'radio'){
                        $this->form.=self::FormRadio($frm);
                    }

                    if($frm['tipe'] == 'checkbox'){
                        $this->form.=self::FormCheckbox($frm);
                    }

                    if($frm['tipe'] == 'file'){
                        $this->form.=self::FormFile($frm);
                    }

                    if($frm['tipe'] == 'select'){
                        $this->form.=self::FormSelect($frm);
                    }

                    if($frm['tipe'] == 'database'){
                        $this->form.=self::FormDatabase($frm);
                    }

                    if($frm['tipe'] == 'date'){
                        $this->form.=self::FormDate($frm);
                    }

                    if($frm['tipe'] == 'peta'){
                        $this->form.=self::FormPeta($frm);
                    }

                    if($frm['tipe'] == 'number'){
                        $this->form.=self::FormUang($frm);
                    }

                    if($frm['tipe'] == 'kbli'){
                        $this->form.=self::FormKBLI($frm);
                    }
                }
            }
        }
    }

    public static function FormUang($data)
    {
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.=" <div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            if(is_null($data['value'])){
                $form.= \Form::text($data['field'], old($data['field']), ['class'=>'form-control mata-uang']);
            }else{
            	$uang = str_replace(".00","", $data['value']);
                $form.= \Form::text($data['field'], $uang, ['class'=>'form-control mata-uang']);
            }

        $form.= "</div></div>";

        return $form;
    }

    public static function FormKBLI($data)
    {
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.=" <div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            $form.="<div class='input-group'>";
            if(is_null($data['value'])){
                $form.= \Form::text($data['field'], old($data['field']), ['class'=>'form-control','id'=>'data-kbli']);
            }else{
                $form.= \Form::text($data['field'], $data['value'], ['class'=>'form-control','id'=>'data-kbli']);
            }
            $form.="<span class='input-group-btn'>
                <button class='btn btn-light' type='button' id='btn-kbli' data-provide='modaler'  data-url='".url('kbli')."' data-size='lg' data-type='bottom' data-on-confirm='pilih_kbli' data-confirm-text='Pilih KBLI'>KBLI</button>
            </span>";
        $form.= "</div></div></div>";

        return $form;
    }

    public static function FormPeta($data)
    {
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.=" <div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            $form.= "<div id='frm_peta' style='height:350px;'></div>";
            $form.= "<div class='input-group'>";
            $form.= "<span class='input-group-addon'><i class='ti-pin2'></i> Titik Koordinat Lokasi</span>";
            if(is_null($data['value'])){
                $form.= \Form::text($data['field'], old($data['field']), ['class'=>'form-control','id'=>'peta_value']);
            }else{
                $form.= \Form::text($data['field'], $data['value'], ['class'=>'form-control','id'=>'peta_value']);
            }
            $form.= "</div>";
        $form.= "</div></div>";

        return $form;
    }

    public static function FormText($data){
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.=" <div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            if(is_null($data['value'])){
                $form.= \Form::text($data['field'], old($data['field']), ['class'=>'form-control']);
            }else{
                $form.= \Form::text($data['field'], $data['value'], ['class'=>'form-control']);
            }

        $form.= "</div></div>";

        return $form;
    }

    public static function FormTextarea($data){
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.= "<div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            if(is_null($data['value'])){
                $form.= \Form::textarea($data['field'], $data['data'], ['class'=>'form-control','rows'=>'4']);
            }else{
                $form.= \Form::textarea($data['field'], $data['value'], ['class'=>'form-control','rows'=>'4']);
            }

        $form.= "</div>";
        $form.= "</div>";

        return $form;
    }

    public static function FormRadio($data){
        $val = explode(",", $data['data']);

            $form = "<div class='".$data['col']." col-sm-12'>";
            $form.= "<div class='form-group'>";
                $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                foreach($val as $rd){
                    $form.= "<div class='custom-controls-stacked'>";
                        $form.= "<label class='custom-control custom-radio'>";
                        if(!empty($data['value'])){
                            $form.= \Form::radio($data['field'],$rd, ($rd == $data['value']) ? true : false,['class'=>'custom-control-input']);
                        }else{
                            $form.= \Form::radio($data['field'],$rd, false,['class'=>'custom-control-input']);
                        }
                        
                        $form.= "<span class='custom-control-indicator'></span>";
                        $form.= "<span class='custom-control-description'>$rd</span></label>";
                    $form.= "</div>";
                }
            $form.= "</div>";
            $form.= "</div>";

            return $form;
    }
    public static function FormCheckbox($data){
        $val = explode(",", $data['data']);
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.= "<div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            foreach($val as $rd){
                $form.= "<div class='custom-controls-stacked'>";
                    $form.= "<label class='custom-control custom-checkbox'>";
                    if(empty($data['value']) && count($data['value'] > 0) && !is_null($data['value'])){
                        $form.= \Form::checkbox($data['field']."[]",$rd, null,['class'=>'custom-control-input']);
                    }else{
                        if(is_array($data['value'])){
                            $form.= \Form::checkbox($data['field']."[]",$rd, (in_array($rd, $data['value'])) ? true : false,['class'=>'custom-control-input']);
                        }else{
                            $form.= \Form::checkbox($data['field']."[]",$rd, false,['class'=>'custom-control-input']);
                        }
                        
                    }

                    $form.= "<span class='custom-control-indicator'></span>";
                    $form.= "<span class='custom-control-description'>$rd</span></label>";
                $form.= "</div>";
            }
        $form.= "</div>";
        $form.= "</div>";

        return $form;
    }

    public static function FormFile($data){
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.= "<div class='input-group form-type-combine file-group'>";
            $form.= "<div class='input-group-input'>";
                $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                $form.= \Form::text($data['field']."_value",null, ['class'=>'form-control file-value']);
                $form.= \Form::file('file');
            $form.= "</div>";
            $form.= '<span class="input-group-btn"><button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button></span>';
        $form.= "</div>";
        $form.= "</div>";

        return $form;
    }

    public static function FormSelect($data){
        $val = explode(",", $data['data']);
        $arr = [];
        foreach($val as $r){
            $arr[$r] = $r;
        }

        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.= "<div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            $form.= \Form::select($data['field'], $arr, $data['value'], ['class'=>'form-control','data-provide'=>'selectpicker','data-live-search'=>'true']);
        $form.= "</div>";
        $form.= "</div>";

        return $form;
    }

    public static function FormDatabase($data){

        $ajax = ['App\Models\Kecamatan','App\Models\Kelurahan','App\Models\Padukuhan'];

        if(in_array($data['data'], $ajax)){

            if(!is_null($data['value'])){
                if($data['data'] == 'App\Models\Kecamatan'){
                    $model  = app($data['data']);
                    $val = $model::all();
                    $arr = [];
                    foreach($val as $r){
                        $arr[$r->name] = $r->name;
                    }

                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], $arr, $data['value'], ['id'=>'kecamatan-ajax-edit','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true','data-url'=>url('ajax/kelurahan')]);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;

                }elseif($data['data'] == 'App\Models\Kelurahan'){
                    $kel = \App\Models\Kelurahan::where('name', $data['value'])->first();
                    $kel_kec = \App\Models\Kelurahan::where('kecamatan', $kel->kecamatan)->get()->pluck('name','name')->toArray();
                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], $kel_kec, $data['value'], ['id'=>'kelurahan-ajax','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true','data-url'=>url('ajax/padukuhan')]);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;
                }elseif($data['data'] == 'App\Models\Padukuhan'){
                    $ped = \App\Models\Padukuhan::where('name', $data['value'])->first();
                    $kel_ped = \App\Models\Padukuhan::where('kelurahan', $ped->kelurahan)->get()->pluck('name','name')->toArray();
                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], $kel_ped, $data['value'], ['id'=>'padukuhan-ajax','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true']);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;
                }
            }else{
                if($data['data'] == 'App\Models\Kecamatan'){
                    $model  = app($data['data']);
                    $val = $model::all();
                    $arr = [];
                    foreach($val as $r){
                        $arr[$r->name] = $r->name;
                    }

                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], $arr, $data['value'], ['id'=>'kecamatan-ajax','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true','data-url'=>url('ajax/kelurahan')]);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;

                }elseif($data['data'] == 'App\Models\Kelurahan'){
                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], [], $data['value'], ['id'=>'kelurahan-ajax','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true','data-url'=>url('ajax/padukuhan')]);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;
                }elseif($data['data'] == 'App\Models\Padukuhan'){
                    $form = "<div class='".$data['col']." col-sm-12'>";
                    $form.= "<div class='form-group'>";
                        $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                        $form.= \Form::select($data['field'], [], $data['value'], ['id'=>'padukuhan-ajax','class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true']);
                    $form.= "</div>";
                    $form.= "</div>";
                    return $form;
                }
            }

        }else{
            if(str_contains($data['data'], '|')){
                $base_model = explode("|", $data['data']);
                $model = app($base_model[0]);
                $var = explode(",", $base_model[1]);
                $val = $model::where($var[0], $var[1])->get();
            }else{
                $model = app($data['data']);
                $val = $model::get();
            }

            $arr = [];
            foreach($val as $r){
                $arr[$r->name] = $r->name;
            }

            $form = "<div class='".$data['col']." col-sm-12'>";
            $form.= "<div class='form-group'>";
                $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
                $form.= \Form::select($data['field'], $arr, $data['value'], ['class'=>'form-control show-tick','data-provide'=>'selectpicker','data-live-search'=>'true']);
            $form.= "</div>";
            $form.= "</div>";

            return $form;
        }
    }

    public static function FormDate($data){
        $form = "<div class='".$data['col']." col-sm-12'>";
        $form.= "<div class='form-group'>";
            $form.= "<label ".self::is_required($data).">".$data['label']."</label>";
            $form.= "<div class='input-group'>";
                if(is_null($data['value'])){
                    $form.= \Form::text($data['field'], old($data['field']), ['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','data-language'=>'id']);
                }else{
                    $form.= \Form::text($data['field'], $data['value'], ['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','data-language'=>'id']);
                }

                $form.= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
            $form.= "</div>";
        $form.= "</div>";
        $form.= "</div>";

        return $form;
    }

    public static function is_required($data)
    {
        if(isset($data['validation'])){
            if(str_contains($data['validation'], 'required')){
                return "class='required'";
            }
        }
    }

}
