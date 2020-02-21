<?php

/*
 * Tile Function v1.0
Title function that echo the page Title in case the page
has the variable $pageTitle and echo Dafault Title for other page

*/

function getTitle()
{

    global $pageTitle;

    if (isset($pageTitle)) {

        echo $pageTitle;

    } else {

        echo 'Default';
    }

}


/*
 * Home Redirect Function v2.0
 * [This Function Accept Parameters]
 * $theMsg = Echo The Message [Error | Success | Warning]
 * $url = The Lik you Want To redirect to
 * $seconds = Seconds Before Redirecting
 * */

function redirectHome($theMsg, $url = null, $seconds = 4)
{

    if ($url === null) {

        $url = 'index.php';

        $link = 'HomePage';

    } else {

        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

            $url = $_SERVER['HTTP_REFERER'];

            $link = 'Previous Page';

        } else {

            $url = 'index.php';

            $link = 'HomePage';

        }

    }

    echo $theMsg;

    echo "<div class='alert alert-info'> You Will Be Redirected To $link After $seconds Seconds</div>";

    header("refresh: $seconds;url=$url");

    exit();

}

/*
 * Check Item Function v1.0
 * Function To Check Item In Database [Function Accept Parameters]
 * $select  = The Item To Select [ Example: user, Item, Categories ]
 * $from = The Table To select From [ Example: user, Item, Categories ]
 * $value = The Value Of Select [ Example: admin, Box, Electronics]
 * */

function checkItem($select, $from, $value)
{

    global $con;

    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    return $count;
}

/*
 * Count number of Item function v1.0
 * function to count number of items rows
 * $item = The item to count
 * $table = The table to choose from
 * */

function countItems($item, $table)
{

    global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

    $stmt2->execute();

    return $stmt2->fetchColumn();
}

/*
 * Get Latest Record Function v1.0
 * function to get latest Item fom database [Users, Items, Comments]
 * $select = Field to select
 * $order = The Desc Ordering
 * $table = The table to Choose From
 * $limit = The Number of Records to Get
 *
 * */

function getLatest($select, $table, $order, $limit = 5)
{

    global $con;

    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

    $getStmt->execute();

    $rows = $getStmt->fetchAll();

    return $rows;
}

//getAllFrom($field,$table,$where = NULL,$orderfield,$ordering = 'DESC');