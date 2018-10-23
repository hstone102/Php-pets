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
  <body>

<?php

    $db = pg_connect("host=localhost port=5432 dbname=classroom2 user=classroom2user password=twotwotwo");
    $petList = pg_query("select name, species, breed, adoption_fee from pets order by name");

?>

    <h1>PHP Pets Adoption Service</h1>

    <h3>List of Pets</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Species/Breed</th>
                <th>Adoption Fee</th>
            </tr>
        </thead>
        <tbody>

<?php
    while ($row = pg_fetch_row($petList)) {
?>
            <tr>
                <td><?=$row[0]?></td>
                <td><?=$row[1]?> <?=$row[2]?></td>
                <td><?=$row[3]?></td>
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
