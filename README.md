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
