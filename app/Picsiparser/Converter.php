<?php 
namespace App\Picsiparser;

class Converter
{

    public $ooxml;

    public function __construct($html)
    {
        $this->ooxml = $html;
    }

    public function HtmlToMsWord()
    {
		$start = 0;
		$properties = array();
		$openxml = Cleaner::cleanUpHTML($this->ooxml);
		$openxml = $this->getOpenXML($openxml);
		$openxml = $this->processBreaks($openxml);
		$openxml = $this->processListStyle($openxml);
		$openxml = Proccessor::processPropertiesStyle($openxml, $start, $properties);
		$openxml = $this->processSpaces($openxml);
		$openxml = $this->processStyle($openxml);
		
		return $openxml;
    }

	private function getOpenXML($text) {
		$text = "<w:p><w:r><w:t>$text</w:t></w:r></w:p>";
		return $text;
	}
	
	private function processListStyle($input) {
		$output = preg_replace("/(<ul>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $input);
		$output = preg_replace("/(<\/ul>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<ol>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<\/ol>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<li>)/mi", "</w:t></w:r><w:p startliste><w:r><w:t>", $output);
		$output = preg_replace("/(<\/li>)/mi", "", $output);
		return $output;
	}
	
	private function processBreaks($input) {
		$output = preg_replace("/(<\/p>)/mi", "</w:t></w:r></w:p><w:p><w:r><w:t>", $input);
		$output = preg_replace("/(<br>)/mi", "</w:t></w:r></w:p><w:p><w:r><w:t>", $input);
		return $output;
	}
	
	private function processSpaces($input) {
		$output = preg_replace("/(&nbsp;)/mi", "", $input);
		$output = preg_replace("/(<w:t>)/mi", "<w:t xml:space='preserve'>", $output);
		return $output;
	}
	
	private function processStyle($input) {
		$output = preg_replace("/(<w:p>)/mi", "<w:p><w:pPr></w:pPr>", $input);
		$output = preg_replace("/(<w:p startliste>)/mi", "</w:p><w:p><w:pPr><w:pStyle w:val='ListParagraph'/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r></w:r><w:t></w:t>", $output);
		return $output;
	}

}