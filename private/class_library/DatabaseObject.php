<?php

class DatabaseObject 
{
    /**
    * @var PDO $database The declared PDO instance used throughout the class.
    */
    static protected $database;
    /**
     * Database PDO setter.
     *
     * Sets the database connection object.
     *
     * @param PDO $database PDO object to set as the class PDO.
     */
    static public function set_database(PDO $database): void
    {
        try {
            self::$database = $database;
        } catch (Exception $e) {
            die("Can Not Connect To Database" .$e);
        }
    }
    
    static public function test_db()
    {
        try {
            $sql = "SELECT * from prices";
            $stmt = self::$database->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Error ".$e);
        } catch (Exception $e) {
            die("Error ".$e);
        }
    }
}