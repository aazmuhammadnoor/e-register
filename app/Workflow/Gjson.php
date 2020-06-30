<?php 

namespace App\Workflow;

class Gjson
{
    protected $data;
    protected $mode;
    public $filename;
    public $geojson;

    public function __construct($data, $mode='kecamatan')
    {
        $this->data = $data;
        $this->mode = $mode;
        $this->filename = $data->name.".geojson";

        $this->cekFileExists();
    }

    public function GeneratedAsset()
    {
        return asset("geojson/".$this->mode."/".$this->filename);
    }

    protected function cekFileExists()
    {
        $path = $this->getPath().$this->filename;
        if(!\File::exists($path)) {
			$this->GenerateGjsonFormat();
        }
        
        return $path;
    }

    protected function GenerateGjsonFormat()
    {
        //bikin folder jika ga ada
        $this->GenerateGsjonFolder();

        //explode koordinat
        $koordinat = array_map(function($e){
            $a = explode(",", $e);
            return [
                $a[1],$a[0]
            ];
        }, explode(";", $this->data->polygon));

        $arr_feature = [
            'type'=>'FeatureCollection',
            'features'=>[[
                'type'=>'Feature',
                'properties'=>[
                    "stroke" => "#555555",
                    "stroke-width" => 2,
                    "stroke-opacity" => 1,
                    "fill" => $this->data->warna,
                    "fill-opacity" => 0.5,
                    "name"=>$this->data->name,
                    "popupContent"=>$this->mode." ".$this->data->name
                ],
                'geometry'=>[
                    'type'=>'Polygon',
                    'coordinates'=>[$koordinat]
                ]
            ]]
        ];

        $this->geojson = json_encode($arr_feature, JSON_NUMERIC_CHECK);
        $path = $this->getPath().$this->filename;
        $bytes_written = \File::put($path, $this->geojson);
        if ($bytes_written === false)
        {
            die("Error writing to file");
        }
    }

    protected function getPath()
    {
        $path = public_path("geojson/".$this->mode."/");
        return $path;
    }

    protected function GenerateGsjonFolder()
    {
        $path = $this->getPath();
		if(!\File::exists($path)) {
			\File::makeDirectory($path, 0775, true, true);
		}
    }
}