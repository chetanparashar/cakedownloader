<?php

App::uses('AppModel', 'Model');

class PresentationExample extends AppModel {
	
	public $useTable = false;
	public function GeneratePresentation($text){		
                App::uses('Presentation', 'Lib/PHPPresentation');
                $objPresentation = new Presentation();
		$currentSlide = $objPresentation->getActiveSlide();
		//LOGO
		$shape = $currentSlide->createDrawingShape();
		$shape->setName('logo')
		->setDescription('logo')
		->setPath(APP . 'webroot/img/phppowerpoint_logo.png')
		->setHeight(36)
		->setOffsetX(10)
		->setOffsetY(10);
		$shape->getShadow()->setVisible(true)
		->setDirection(45)
		->setDistance(10);
		//TEXT
		$shape = $currentSlide->createRichTextShape()
		->setHeight(50)
		->setWidth(600)
		->setOffsetX(170)
		->setOffsetY(300);
		$shape->getActiveParagraph()->getAlignment()->setHorizontal(PhpOffice\PhpPresentation\Style\Alignment::HORIZONTAL_CENTER);
		$textRun = $shape->createTextRun($text);
		$textRun->getFont()->setBold(true)->setSize(20);
		// Save file
		$filename = "Example_" . microtime();
		return $objPresentation->writeodp($objPresentation, $filename);
                //return $objPresentation->writepptx($objPresentation, $filename);
	}
}
