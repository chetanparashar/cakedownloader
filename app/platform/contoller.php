<?php
report controller
public function PlatformUsage() {
         $this->setLayoutData();
    }
boController
   public function JsonDownloadReport() {
        
	            case "PLATFORMUSAGE":
                        $this->loadModel("PwPucDetails");
                        $filename = $this->PwPucDetails->getdata($this->request->data);
                        break;
      
}
