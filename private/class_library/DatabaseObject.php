<?php

class DatabaseObject
{
    /**
     * @var PDO $database The declared PDO instance used throughout the class.
     */
    static protected $database;
    /**
    * @var bool $newItem Whether or not this is for a new row in the selected table(static).
    */
    static protected $newItem = false;
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
            die("Can Not Connect To Database" . $e);
        }
    }

    /**
     * Get Table Attributes.
     *
     * Builds a list of attributes (organized information based on rows and information to go into those rows)
     * of the declared table and returns the list as an array.
     *
     * @return string[] The list of table attributes.
     */
    protected function attributes(): array
    {
        try {
            $attributes = [];
            $i = 0;
            foreach (static::$db_columns as $column) {
                $attributes[$column] = $this->$column;
                $i++;
            }
            return $attributes;
        } catch (Exception $e) {
            die("Error " . $e);
        }
    }

       /**
     * Clean Query Attributes.
     *
     * This method cleans the attributes before they are able to be used in a query.
     *
     * @param mixed[] $checkThis What needs to be cleaned.
     * @param PDOStatement $result A PDO prepared statement that was generated prior to calling this method.
     * @return bool Whether or not the cleaning was successful or not.
     */
    protected static function sanitize_attributes(array $checkThis, PDOStatement $result)
    {
        try {
            if (static::$newItem) {
                $i = 1;
            } else {
                $i = 0;
            }
            foreach ($checkThis as $key => &$value) {
                $stringIt = ':' . $i;
                if ($value !== null or $value !== "") { // checks if null
                    $result->bindParam($stringIt, $value, PDO::PARAM_STR);
                } else { // Allow null value to be passed into the statement
                    echo ("NULL PASSED");
                    $result->bindValue($stringIt, null);
                }
                $i++;
            }
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        }  catch (PDOException $e) {
            die("ERROR :" .$e);
        }
    }

    public function create(): bool
    { 
        try {
            $attributes = $this->attributes();
            $sql = "INSERT INTO " . static::$table_name . " (" . join(', ', array_keys($attributes));
            $sql .= ") VALUES (";
            if (static::$newItem) {
                $length = sizeof($attributes) + 1;
            } else {
                $length = sizeof($attributes);
            }
            for ($i = 0; $i < $length; $i++) {
                if ($i == 0) {
                    if (static::$newItem) {
                        continue;
                    }
                }
                $sql .= ":" . $i;
                $m = $i + 1;
                if ($m != $length) {
                    $sql .= ", ";
                }
            }
            $sql .= ")";
            $result = self::$database->prepare($sql);
            if ($result) {
                if ($this->sanitize_attributes($attributes, $result)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        catch (PDOException $e) {
            die("ERROR " .$e);
        } catch (Exception $e) {
            die("ERROR " .$e);
        }
    }

    public function update(string $idName,string $id) : bool 
    {
        try {
            $attributes = $this->attributes();
            if (static::$newItem) {
                $i = 1;
                $length = sizeof($attributes) + 1;
            } else {
                $i = 0;
                $length = sizeof($attributes);
            }

            $sql = "UPDATE " . static::$table_name . " SET ";
            foreach ($attributes as $key => $value) {
                $sql .= $key . " = :" . $i;
                $m = $i + 1;
                if ($m != $length) {
                    $sql .= ", ";
                }
                $i++;
            }
            $sql .= " WHERE " . $idName . " = :id";
            $result = self::$database->prepare($sql);
            if ($id == "" || $id == NULL) {
                $id = NULL;
            }
            $result->bindParam(':id', $id, PDO::PARAM_STR);
            if ($result) {
                if ($this->sanitize_attributes($attributes, $result)) {
                    return true;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            self::send_error_to_log($e);
            return false;
        } catch (Exception $e) {
            self::send_error_to_log($e);
            return false;
        }
    }

    static public function find_many_by_sql(string $sql)
    {
        try {
            $result = self::$database->query($sql);
            if ($result) {
                $result->execute();
                $row = $result->fetchAll();
                return $row;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("ERROR :" .$e);
        }
    }

    /**
     * Find a Single Row.
     *
     * This method helps find a single row from a given query. This should only be used if you expect a single row.
     *
     * @param string $sql The sql query to fetch the single row.
     * @return mixed[]|bool If there is a result then this is an associative array for the row returned, otherwise it is
     * false.
     */
    static public function find_uno_by_sql(string $sql)
    {
        $result = self::$database->query($sql);
        $result->execute();
        if ($row = $result->fetch()) {
            return $row;
        } else {
            return false;
        }
    }

    static public function select_with_order($order1 = '', $order2='')
    {
        $sql = "SELECT * FROM " . static::$table_name;
        if (!empty($order1)) {
            $sql .= " ORDER BY " . $order1 . " ASC";
        }
        if (!empty($order2)) {
            $sql .= ", " . $order2 . " ASC";
        }
        return static::find_many_by_sql($sql);
    }

    static public function find_by_anything($id,string $idName, bool $multiple)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE " . $idName . " = '" . $id . "'";
        if ($multiple) {
            return static::find_many_by_sql($sql);
        } else {
            return static::find_uno_by_sql($sql);
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
            die("Error " . $e);
        } catch (Exception $e) {
            die("Error " . $e);
        }
    }
}
