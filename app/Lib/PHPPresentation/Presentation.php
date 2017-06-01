<?php

require_once 'PhpPresentation/Autoloader.php';
PhpOffice\PhpPresentation\Autoloader::register();
require_once 'Common/Autoloader.php';
PhpOffice\Common\Autoloader::register();

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Color;

class Presentation extends PhpPresentation{

	public function writepptx($PresentationObj, $filename){
		$xmlWriter = IOFactory::createWriter($PresentationObj, 'PowerPoint2007');
		$filename = preg_replace('/[\s]+/', '_', $filename);
		$filename = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $filename);
		$xmlWriter->save( TMP . DS . $filename . ".pptx");
		return $filename . ".pptx";
	}

	public function writeodp($PresentationObj, $filename){
		$xmlWriter = IOFactory::createWriter($PresentationObj, 'ODPresentation');
		$filename = preg_replace('/[\s]+/', '_', $filename);
		$filename = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $filename);
		$xmlWriter->save( TMP . DS . $filename . ".odp");
		return $filename . ".odp";
	}

}