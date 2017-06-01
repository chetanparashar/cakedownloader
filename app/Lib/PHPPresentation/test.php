<?php

include_once 'Presentation.php';
define('EOL','<br />');

// Create new Presentation object
echo date('H:i:s') . ' Create new Presentation object' . EOL;
$objPresentation = new Presentation();

// Set properties
//echo date('H:i:s') . ' Set properties' . EOL;
//$objPHPPresentation->getDocumentProperties()->setCreator('PHPOffice')
//    ->setLastModifiedBy('PHPPresentation Team')
//    ->setTitle('Sample 01 Title')
//    ->setSubject('Sample 01 Subject')
//    ->setDescription('Sample 01 Description')
//    ->setKeywords('office 2007 openxml libreoffice odt php')
//    ->setCategory('Sample Category');

// Create slide
echo date('H:i:s') . ' Create slide' . EOL;
$currentSlide = $objPresentation->getActiveSlide();

// Create a shape (drawing)
echo date('H:i:s') . ' Create a shape (drawing)' . EOL;
$shape = $currentSlide->createDrawingShape();
$shape->setName('PHPPresentation logo')
    ->setDescription('PHPPresentation logo')
    ->setPath('phppowerpoint_logo.gif')
    ->setHeight(36)
    ->setOffsetX(10)
    ->setOffsetY(10);
$shape->getShadow()->setVisible(true)
    ->setDirection(45)
    ->setDistance(10);
//$shape->getHyperlink()->setUrl('https://github.com/PHPOffice/PHPPresentation/')->setTooltip('PHPPresentation');

// Create a shape (text)
echo date('H:i:s') . ' Create a shape (rich text)' . EOL;
$shape = $currentSlide->createRichTextShape()
    ->setHeight(300)
    ->setWidth(600)
    ->setOffsetX(170)
    ->setOffsetY(180);
$shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$textRun = $shape->createTextRun('Thank you for using PHPPresentation!');
$textRun->getFont()->setBold(true)
    ->setSize(60)
    ->setColor(new Color('FFE06B20'));

// Save file
$objPresentation->writepptx($objPresentation, __DIR__ . "/test");
//$xmlWriter = IOFactory::createWriter($objPHPPresentation, 'PowerPoint2007');
//$xmlWriter->save(__DIR__ . "/test.pptx");
echo "Done";
