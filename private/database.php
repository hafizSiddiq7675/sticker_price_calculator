<?php

require_once('database_credentials.php');

/**
 * @return PDO
 */
function db_connect() : PDO
{
    try{
        $connection = new PDO(DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $connection;
}

/**
 * @param PDO $connection
 */
function db_disconnect(PDO $connection) : void
{
    if(isset($connection)) {
        $connection = NULL;
    }
}

/**
 * @param PDO $connection
 * @param string $string
 * @return string
 */
function db_escape(PDO $connection, string $string) : string
{
    return $connection->quote($string);
}

/**
 * @param $result_set
 */
function confirm_result_set($result_set) : void
{
    if(!$result_set) {
        exit("Database query failed");
    }
}