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

      <p class="text-left"><a href="/">Back to Pet List</a></p>

<?php

    $error_message = '';
    $row = [];

    $safeId = htmlentities($_GET["id"]);

    if (!isset($safeId) || $safeId == '') {
        $error_message = "Pet ID is missing. Sorry!";
    }
    else {
        include("util/utilities.php");
        $db = getDb();

        $pet = pg_query("SELECT p.*, cl.level, cl.description AS care_level_description
            FROM pets AS p
            JOIN care_levels AS cl ON cl.id = p.care_level_id
            WHERE p.id = " . intval($safeId));

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

<?php if ($row["is_adopted"] == "t") { ?>
    <div class="alert alert-success">This pet already has a home! Yay!</div>
<?php } ?>

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

    <div class="form-group">
        <label for="petAge">Age (in years)</label>
        <input id="petAge" class="form-control" readonly value="<?=$row["age_in_years"]?>">
    </div>

    <div class="form-group">
        <label for="petWeight">Weight (in pounds)</label>
        <input id="petWeight" class="form-control" readonly value="<?=$row["weight_in_pounds"]?>">
    </div>

    <div class="form-group">
        <label for="petSex">Sex</label>
        <input id="petSex" class="form-control" readonly value="<?=$row["sex"]?>">
    </div>

    <div class="form-group">
        <label for="petIsFixed">Spayed/Neutered?</label>
        <input id="petIsFixed" class="form-control" readonly value="<?php echo $row["is_fixed"] == "t" ? "Yes" : "No" ?>">
    </div>

    <div class="form-group">
        <label for="petKids">Good with Kids?</label>
        <input id="petKids" class="form-control" readonly value="<?php echo $row["is_good_with_kids"] == "t" ? "Yes" : "No" ?>">
    </div>

    <div class="form-group">
        <label for="petCareLevel">Care Level</label>
        <textarea id="petCareLevel" class="form-control" readonly><?=$row["level"]?>: <?=$row["care_level_description"]?></textarea>
    </div>

    <div class="form-group">
        <label for="petFee">Adoption Fee</label>
        <input id="petFee" class="form-control" readonly value="$<?=sprintf("%01.2f", $row["adoption_fee"]);?>">
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
