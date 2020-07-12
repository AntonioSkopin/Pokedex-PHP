<?php
    include "config/database.php";

    $database = new Database();
    $conn = $database->getConnection();

    $query = $conn->prepare("SELECT naam FROM pokemon");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    // Get the q parameter from URL
    $q = $_REQUEST["q"];

    $hint = "";
    $count = 0;

    // Lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q); // Lowercase all letters in q
        $len = strlen($q); // Get length of string q
        foreach ($data as &$name) {
            if ($count == 4) {
                break;
            }
            if (stristr($q, substr($name["naam"], 0, $len))) {
                // Checks if the first occurence of q is the same as the first letter of the current element
                if ($hint === "") {
                    $hint .= "- " . $name["naam"];
                } else {
                    $hint .= "<br>- " . $name["naam"];
                    $count++;
                }
            }
        }
    }
    
    // Output "Geen naam gevonden" if no hint was found or output correct values
    echo $hint === "" ? "<br>Geen naam gevonden" : $hint;