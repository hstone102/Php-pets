<?php

    function getDb() {
        return pg_connect("host=localhost port=5432 dbname=classroom2 user=classroom2user password=twotwotwo");
    }

?>
