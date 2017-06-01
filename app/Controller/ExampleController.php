<?php

App::uses('AppController', 'Controller');

class ExampleController extends AppController {
	
	public function index() {
		if($this->request->is('post') && isset($this->request->data['text']) && ! empty($this->request->data['text'])){
			$this->loadModel('PresentationExample');
			$filename = $this->PresentationExample->GeneratePresentation($this->request->data['text']);
			if (!empty($filename)) {
			    $this->response->download($filename);
			    $fl = fopen(TMP . $filename, 'r');
			    $this->set('filedata', fread($fl, filesize(TMP . $filename)));
			    fclose($fl);
			    unlink(TMP . $filename);
			    $this->render('/Elements/files');
      		      }
		}
	}
}
