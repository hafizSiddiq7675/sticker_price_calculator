<?php
require_once('../database.php');

$db = PDO::db_connect();
$sql = "CREATE TABLE `sticker_price_calculator`.`prices` ( `id` INT NOT NULL , `width` FLOAT NULL , `height` FLOAT NULL , `price` FLOAT NULL , `min_charge` FLOAT NULL ) ENGINE = InnoDB";
$db->exec($sql);
echo "Created Product Table";
$sql = "ALTER TABLE `prices` ADD PRIMARY KEY(`id`)";
$db->exec($sql);
$sql = "ALTER TABLE `prices` ADD `quantity` INT NULL AFTER `price`";
$b->exec($sql);
echo "Added PK Constrain";