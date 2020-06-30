<?php 

namespace App\Picsiparser;

class Proccessor
{
	public static function processPropertiesStyle($input, $nbre, $ppties) {
		$properties = array();
		$html = $input;
		$i0 = $nbre;
		for ($i=$i0; $i < strlen($html); $i++){
			if ($html[$i] == "<")
			{
				switch ($html[$i+1]) {
					case "i":
						list ($properties, $writeproperties) = self::addProperty("italic", $properties);
						$html = substr_replace($html, $writeproperties, $i , 3);
						break;
					case "b":
						list ($properties, $writeproperties) = self::addProperty("bold", $properties);
						$html = substr_replace($html, $writeproperties, $i , 3);
						break;
					case "u":
						list ($properties, $writeproperties) = self::addProperty("underlined", $properties);
						if ($html[$i+2] == ">"){
						$html = substr_replace($html, $writeproperties, $i , 3);
						break;
						} else break;
					case "w":
						break;
					case "/":
						$html = self::removeEndBracket($html, $properties, $i);
						break;
					default:
						$html = self::suppressStyle($i, $html);
						$i = $i-1;
						break;
				}
			}
		}
		return $html;
    }
    
	private static function removeEndBracket($html, $properties, $i) {
		switch ($html[$i+2]) {
			case "i":
				list ($properties, $writeproperties) = self::removeProperty("italic", $properties);
				$html = substr_replace($html, $writeproperties, $i, 4);
				break;
			case "b":
				list ($properties, $writeproperties) = self::removeProperty("bold", $properties);
				$html = substr_replace($html, $writeproperties, $i, 4);
				break;
			case "u":
				list ($properties, $writeproperties) = self::removeProperty("underlined", $properties);
				$html = substr_replace($html, $writeproperties, $i, 4);
				break;
			case "w":
				break;
			default:
				$html = self::suppressStyle($i, $html);
				break;
		}
		return $html;
    }
    
	private static function addProperty($property, $properties) {
		array_push($properties, $property);
		return array( 
			$properties, 
			self::setProperty($properties),
		);
    }
    
	private static function removeProperty($property, $properties) {
		foreach ($properties as $key => $value) {
			if ($value == $property){
				unset($properties[$key]);
				$properties = array_values($properties);
			}
		}
		return array(
			$properties, 
			self::setProperty($properties),
		);
    }
    
	private static function setProperty($properties) {
		$propertiesList = "</w:t></w:r><w:r><w:rPr>";
		foreach ($properties as $value) {
			switch ($value) {
				case "italic":
					$propertiesList = $propertiesList."<w:i/>";
					break;
				case "bold":
					$propertiesList = $propertiesList."<w:b/>";
					break;
				case "underlined":
					$propertiesList = $propertiesList."<w:u w:val='single'/>";
					break;
				default:
					break;
			}	
		}
		$propertiesList = $propertiesList."</w:rPr><w:t>";
		return $propertiesList;
    }
    
	private static function suppressStyle($nb, $html) {
		$j = false;
		$i = 0;
		while($j == false){
			if($html[($nb+$i)]==">"){
				$j = true;
			}
			else{
				$i = $i+1;
			}
		}
		$html = substr_replace($html, "", $nb , $i+1);
		return $html;
	}
}