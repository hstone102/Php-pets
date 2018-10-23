<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>PHP Pets Adoption Service</title>
  </head>
  <body class="container mt-3">

<?php

    include("util/utilities.php");
    $db = getDb();
    $petList = pg_query($db, "SELECT p.id, p.name, p.species, p.breed, p.adoption_fee, cl.level, cl.description
FROM pets AS p
JOIN care_levels AS cl ON p.care_level_id = cl.id
WHERE is_adopted = false
ORDER BY name");

?>

    <h1>PHP Pets Adoption Service</h1>

    <h3 class="mb-4 mt-4">List of Pets</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Species/Breed</th>
                <th>Care Level</th>
                <th>Adoption Fee</th>
            </tr>
        </thead>
        <tbody>

<?php
    while ($row = pg_fetch_assoc($petList)) {
?>
            <tr>
                <td><a href="detail.php?id=<?=$row["id"]?>"><?=$row["name"]?></a></td>
                <td><?=$row["species"]?><?php if ($row["breed"]) { echo ", " . $row["breed"]; } ?></td>
                <td data-toggle="tooltip" data-placement="bottom" title="<?=$row["description"]?>"><?=$row["level"]?></td>
                <td class="text-right">$<?=sprintf("%01.2f", $row["adoption_fee"]);?></td>
            </tr>
<?php
    }
?>

        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
