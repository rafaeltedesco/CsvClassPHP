<?php
  
  require_once('config.php');

  $filename = 'data\novo';
  $csv = new Csv($filename);

  $csv->read();
  
  //another option to use
  //$otherfilename = 'novo_arquivo';
  //$csv->read($otherfilename);

  $csv->displayDataInJSONFormat();

?>





