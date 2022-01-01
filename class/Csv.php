<?php

class Csv {


  private $filename;
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

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function displayDataInJSONFormat() {
    echo json_encode($this->data);
  }

  public function readCsv($filename){
    if (!file_exists($filename)) throw new Exception("O arquivo " . $filename . " não foi encontrado!");
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