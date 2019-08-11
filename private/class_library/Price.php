<?php 

Class Price extends DatabaseObject 
{
    /**
     * protected class properties
     * @var string $table_name The name of the table for MySQL queries (static).
     * @var string[] $db_columns Known columns in the commissions table (static).
     */
    static protected $table_name = 'prices';
    static protected $db_columns = array(
        'id',
        'width',
        'height',
        'price',
        'quantity',
        'min_charge'
    );

    public $id;
    public $width;
    public $height;
    public $price;
    public $quantity;
    public $min_charge;

    public function __construct(array $args = [])
    {
        $this->id           = trim($args['id']) ?? '';
        $this->width        = trim($args['width']) ?? '';
        $this->height       = trim($args['height']) ?? '';
        $this->price        = trim($args['price']) ?? '';
        $this->min_charge   = trim($args['min_charge']) ?? '';
        $this->quantity     = trim($args['quantity']) ?? '';
    }
}