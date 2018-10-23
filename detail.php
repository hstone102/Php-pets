<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Individual Pet Page</title>
  </head>
  <body class="container mt-3">

<?php

    $error_message = '';
    $row = [];

    if (!isset($_GET["id"]) || $_GET["id"] == '') {
        $error_message = "Pet ID is missing. Sorry!";
    }
    else {
        $id = $_GET["id"];
        $db = pg_connect("host=localhost port=5432 dbname=classroom2 user=classroom2user password=twotwotwo");
        $pet = pg_query("SELECT p.*, cl.level, cl.description AS care_level_description
            FROM pets AS p
            JOIN care_levels AS cl ON cl.id = p.care_level_id
            WHERE p.id = " . $id);
        $row = pg_fetch_assoc($pet);    
        if (!$row) {
            $error_message = "The pet ID supplied didn't match a pet in our database. Sorry!";
        }
    }

    if ($error_message) {
?>

    <div class="alert alert-danger"><?=$error_message?></div>

<?php
    }
    else {
?>

    <h1><?=$row["name"]?></h1>

    <div class="form-group">
        <label for="petSpecies">Species</label>
        <input id="petSpecies" class="form-control" readonly value="<?=$row["species"]?>">
    </div>

    <div class="form-group">
        <label for="petBreed">Breed</label>
        <input id="petBreed" class="form-control" readonly value="<?=$row["breed"]?>">
    </div>

    <div class="form-group">
        <label for="petDescription">Description</label>
        <textarea id="petDescription" class="form-control" readonly><?=$row["description"]?></textarea>
    </div>

<?php
    }
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
