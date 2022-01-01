<?php
  
  require_once('config.php');

  $csv = new Csv('arquivo_de_dados');

  $pkmFile = 'pokemon.csv';
  $netflixFile = 'netflix_titles.csv';

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

  $csv->createCsvFromDataArray($data, 'C:\xampp\htdocs\data_manipulation');
  //$csv->readCsv($netflixFile);
  //$csv->displayDataInJSONFormat();

?>