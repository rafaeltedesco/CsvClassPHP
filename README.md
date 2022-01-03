# CsvClassPHP

## Functionalities

- readCsvFile
- Display Data in JSON format

#### Example:

```
<?php

  require_once('config.php');

  $csv = new Csv();

  $pkmFile = 'pokemon.csv';
  $netflixFile = 'netflix_titles.csv';

  $csv->readCsv($netflixFile);
  $csv->displayDataInJSONFormat();

?>

```

## 01/01/2022 - New Functionality added

- Create Csv File

#### Example:

```
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
```

## 02/01/2022 - Interface and Abstract Class File created aiming less coupling

#### Usage:

![screenshot1](screenshots/screenshot1.png)

![screenshot2](screenshots/screenshot2.png)

![screenshot3](screenshots/screenshot3.png)
