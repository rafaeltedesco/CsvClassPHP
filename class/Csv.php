<?php

class Csv extends File {

  public function __construct(String $filename = '') {
    $this->setFileType('csv');
    $this->setFilename($filename);
    $this->setSeparator(',');
  } 

 }

?>