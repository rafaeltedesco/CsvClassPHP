<?php
  
  require_once('config.php');

  $filename = "novo_arquivo2";
  
  $csv = new Csv($filename);

  $data = array(
    array(
    'nome'=>'Rafael',
    'idade'=> 30
    ), 
  array(
    'nome'=>'Miguel',
    'idade'=>18
    )
  );

  $savepath = 'C:\xampp\htdocs\data_manipulation';

  $csv->createFileFromDataArray($data, $savepath);

  // $newfilename = 'novo_arquivo.csv';
  // it's possible to use passing filename as param either
  //$csv->createFileFromDataArray(
  //   $data, 
  //   $savepath, 
  //   $newfilename
  // );

?>





