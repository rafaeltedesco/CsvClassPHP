<?php

class Csv {


  private $filename;
  private $savepath;
  private $data;

  public function __construct(String $filename = '') {
    $this->setFilename($filename);
  } 

  public function getFilename() {
    return $this->filename;
  }

  public function setFilename($filename) {
    strlen($filename) > 1 ? $this->filename = $filename . '.csv' : $this->filename = '';
  }

  public function getSavepath() {
    return $this->savepath;
  }

  public function setSavepath($savepath) {
    if (!is_dir($savepath)) throw new Exception("Save path must be a valid directory");
    $this->savepath = $savepath;
  }

  public function getFullpath() {
    return $this->getSavepath() . DIRECTORY_SEPARATOR . $this->getFilename();
  }


  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function displayDataInJSONFormat() {
    echo json_encode($this->data);
  }

  public function createCsvFromDataArray(array $data, String $savepath = '',  String $filename = '') {

    if (strlen($filename) > 0) $this->setFilename($filename);
    if (strlen($savepath) > 0) $this->setSavepath($savepath);
    if (!strlen($this->filename) > 0) throw new Exception("Filename must be provided!");
    if (!strlen($this->savepath) > 0) throw new Exception("Savepath must be provided!");    
    
    echo $this->getFullpath();

    $fileResource = fopen($this->getFullpath(), "w");

    // write header

    fwrite($fileResource, implode(',', array_keys($data[0])) . "\r\n");
    
    foreach($data as $row) {

      fwrite($fileResource, implode(',', array_values($row)) . "\r\n");

    }
    
    fclose($fileResource);
    echo "CSV File" . $this->getFilename() . " was successfully created!";
  }

  public function readCsv($filename){
    if (!file_exists($filename)) throw new Exception("Cannot find " . $filename . " !");
    $fileResource = fopen($filename, 'r');
    $headers = explode(",", fgets($fileResource));
    $numberOfColumns = count($headers);
  
    $data = array();

    while ($row = fgets($fileResource)) {

      $rowData = explode(",", $row);
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
 }

?>