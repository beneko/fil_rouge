<?php

sleep(1);

$search = $_REQUEST["searchVal"];

$results = [
    "Smartphone",
    "tablette",
    "PC",
    "Laptop",
    "Accessoires"
];

if (strlen($search) > 0) {
    foreach ($results as $r) {
        if(strpos($r,$search) !== false) {
            $r = str_replace($search,'<br>' . $search . '<br>', $r);
            echo "<span class='span'>" . $r . "</span><br>";
        }
    }
}