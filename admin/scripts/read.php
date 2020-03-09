<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function getAll($tbl)
{
    $pdo = Database::getInstance()->getConnection();

    $queryAll = 'SELECT * FROM ' . $tbl;
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}


function getMovies($tbl, $type)
{
    $pdo = Database::getInstance()->getConnection();

    $queryAll = "SELECT * FROM  $tbl WHERE movie_type = '$type'";
    $results = $pdo->query($queryAll);
    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
};

function getMusics($tbl, $type)
{
    $pdo = Database::getInstance()->getConnection();

    $queryAll = "SELECT * FROM  $tbl WHERE music_type = '$type'";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
};

function getTVs($tbl, $type)
{
    $pdo = Database::getInstance()->getConnection();

    $queryAll = "SELECT * FROM  $tbl WHERE tv_type = '$type'";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
};

function getSingleMovie($tbl, $col, $id)
{
    //TODO: refer the function above to finish this one
    $pdo = Database::getInstance()->getConnection();
    $query = "SELECT * FROM $tbl WHERE $col = $id";

    $results = $pdo->query($query);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem';
    }
}
