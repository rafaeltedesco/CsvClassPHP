<?php

  interface InterfaceFile {

    public static function isValidPath($path);
    public static function isValidFilename($filename):bool;

    public function displayDataInJSONFormat();
    public function createFileFromDataArray(
        array $data, 
        String $savepath = '',  
        String $filename = ''
    );
    public function read(String $filename);

  }


?>