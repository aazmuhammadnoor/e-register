<?php 

namespace App\Picsiparser;

class Cleaner
{
	public static function cleanUpHTML($htmlCode) {
		$cleanHtmlCode = html_entity_decode($htmlCode);
		$cleanHtmlCode = self::cleanFirstDivIfAny($htmlCode);
		$cleanHtmlCode = self::cleanUpFontTagsIfAny($cleanHtmlCode);
		$cleanHtmlCode = self::cleanUpSpanTagsIfAny($cleanHtmlCode);
		$cleanHtmlCode = self::cleanUpParagraphTagsIfAny($cleanHtmlCode);
		$cleanHtmlCode = self::cleanUpEmTagsIfAny($cleanHtmlCode);
		$cleanHtmlCode = self::cleanUpEmptyTags($cleanHtmlCode);
		$cleanHtmlCode = self::cleanUpZeroWidthSpaceCodes($cleanHtmlCode);
		$cleanHtmlCode = self::cleanBRTagsAtTheEndOfListItemsIfAny($cleanHtmlCode);

		return $cleanHtmlCode;
    }
    
	private static function cleanFirstDivIfAny($input) {
		$output = $input;
		if(strpos($output, "<div") === 0) {
			$closeCharPos = strpos($output, ">");
			$output = substr_replace($output, "", 0, $closeCharPos);
			$output = substr_replace($output, "", strlen($output)-strlen("</div>"));
		}
		return $output;
    }
    
	private static function cleanBRTagsAtTheEndOfListItemsIfAny($input) {
		$output = preg_replace("/<br><\/li>/mi", "</li>", $input);
		return $output;
    }
    
	private static function cleanUpFontTagsIfAny($input) {
		$output = preg_replace("/(<font[a-zA-Z0-9_.=,:;#'\"\- \(\)]*>)/mi", "", $input);
		$output = preg_replace("/(<\/font>)/mi", "", $output);
		return $output;
    }
    
	private static function cleanUpSpanTagsIfAny($input) {
		$output = preg_replace("/(<span[a-zA-Z0-9_.=,:;#'\"\- \(\)]*>)/mi", "", $input);
		$output = preg_replace("/(<\/span>)/mi", "", $output);
		return $output;
    }
    
	private static function cleanUpParagraphTagsIfAny($input) {
		$output = preg_replace("/(<p[a-zA-Z0-9_.=,:;#'\"\- \(\)]*>)/mi", "", $input);
		$output = preg_replace("/(<\/p>)/mi", "<br>", $output);
		return $output;
    }
    
	private static function cleanUpEmTagsIfAny($input) {
		$output = preg_replace("/(<em[a-zA-Z0-9_.=,:;#'\"\- \(\)]*>)/mi", "<i>", $input);
		$output = preg_replace("/(<\/em>)/mi", "</i>", $output);
		return $output;
    }
    
	private static function cleanUpZeroWidthSpaceCodes($input) {
		$output = preg_replace("/&#8203;/mi", "", $input);
		return $output;
    }
    
	private static function cleanUpEmptyTags($input) {
		$output = preg_replace("/(<p[a-zA-Z0-9_.=,:;#'\"\- \(\)]*><\/p>)/mi", "", $input);
		$output = preg_replace("/<div[a-zA-Z0-9_.=,:;#'\"\- \(\)]*><\/div>/mi", "", $output);
		$output = preg_replace("/<span[a-zA-Z0-9_.=,:;#'\"\- \(\)]*><\/span>/mi", "", $output);
		$output = preg_replace("/<u><\/u>/mi", "", $output);
		$output = preg_replace("/<i><\/i>/mi", "", $output);
		$output = preg_replace("/<b[a-zA-Z0-9_.=,:;#'\"\- \(\)]*><\/b>/mi", "", $output);

		return $output;
	}
}