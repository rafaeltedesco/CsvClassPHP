<?php

class File implements InterfaceFile {

  private $filetype;
  private $filename;
  private $savepath;
  private $separator;
  private $data;

  public static function isValidPath($path):bool {
    return is_dir($path);
  }

  public static function isValidFilename($filename):bool {
    return strlen($filename) > 1;
  }
  
  public function getFileType() {
    return $this->filetype;
  }

  public function setFileType($filetype) {
    $this->filetype = $filetype;
  }

  public function getFilename() {
    return $this->filename;
  }

  public function setFilename(String $filename) {
   File::isValidFilename($filename) ? $this->filename = $filename . '.' . $this->getFileType() : $this->filename = '';
  }

  public function getSavepath() {
    return $this->savepath;
  }

  public function setSavepath($savepath){
    File::isValidPath($savepath) ? $this->savepath = $savepath : throw new Exception("Save path must be a valid directory");
  }
  public function getFullPath(){
    return File::isValidPath($this->getSavepath()) ? $this->getSavepath() . DIRECTORY_SEPARATOR . $this->getFilename() : $this->getFilename();
  }
  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getSeparator() {
    return $this->separator;
  }

  public function setSeparator($separator) {
    $this->separator = $separator;
  }

  public function displayDataInJSONFormat() {
    echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
  }

  public function createFileFromDataArray(array $data, String $savepath = '',  String $filename = '') {
    if (File::isValidFilename($filename)) {
      $this->setFilename($filename);
    }
    else {
      if (!File::isValidFilename($this->getFilename())) {
        throw new Exception("Filename must be provided!");
      }
    }
      
    $this->setSavepath($savepath);

    $resultData = $this->writeDataInFile($data);

    echo json_encode($resultData, JSON_UNESCAPED_UNICODE);
  }
  

  public function read($filename = ''){
    if (File::isValidFilename($filename)) {
      $this->setFilename($filename);
    }
    else if (!File::isValidFilename($this->getFullPath())) {
      throw new Exception("Full FilePath must be provided.");
    } 

    if (!file_exists($this->getFullPath())) throw new Exception('Cannot find ' . $this->getFullPath() . ' file');
          
   
    $fileResource = fopen($this->getFilename(), 'r');
    $headers = explode($this->getSeparator(), fgets($fileResource));
    $numberOfColumns = count($headers);
  
    $data = array();

    while ($row = fgets($fileResource)) {

      $rowData = explode($this->getSeparator(), $row);
      $rowArray = array();
      for ($col = 0; $col < $numberOfColumns; $col++) {
        $colData = isset($rowData[$col]) ? trim($rowData[$col]) : '';
        $rowArray[trim($headers[$col])] = $colData;       
      }

      array_push($data, $rowArray);

    }

    fclose($fileResource);
    $this->setData($data);    
  }
 
 
  private function writeDataInFile(array $data) {
    try {

      $fileResource = fopen($this->getFullPath(), "w");

      // write header

      fwrite($fileResource, implode($this->getSeparator(), array_keys($data[0])) . "\r\n");
    
      foreach($data as $row) {

        fwrite($fileResource, implode($this->getSeparator(), array_values($row)) . "\r\n");

      }
      
      fclose($fileResource);

      return array(
        'sucess'=> true,
        'message'=> strtoupper($this->getFileType()) . " File - " . $this->getFilename() . " was successfully created!"
      );
      
    }
    catch (Exception $e) {
      return array(
        'sucess'=> false,
        'message' => $e->getMessage()
      );
    }    
  }


}

?>