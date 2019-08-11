<?php
require_once '../private/initialize.php';

$sticker_type = $_POST['sticker_type'];
if($sticker_type === 'square_circle') 
{
    $price_id = $_POST['price_id'];
    if(empty($price_id))
    {
        //create
        $price['id']            = mt_rand(1000,9999);
        $price['width']         = $_POST['width_sq_cir'];
        $price['height']        = $_POST['width_sq_cir'];
        $price['price']         = $_POST['price_sq_cir'];
        $price['quantity']      = $_POST['quantity_sq_cir'];
        $price['min_charge']    = $_POST['min_charge_sq_cir'];
        $obj    = new Price($price);
        $result = $obj->create();
        if($result) 
        {
            header('Location: /sticker-price-calculator/site/');
        }
        else
        {
            die("ERROR in CREATING RECORD");
        }
    }
    else
    {
        //EDIT
        $price['id']            = $_POST['price_id'];
        $price['width']         = $_POST['width_sq_cir'];
        $price['height']        = $_POST['width_sq_cir'];
        $price['price']         = $_POST['price_sq_cir'];
        $price['quantity']      = $_POST['quantity_sq_cir'];
        $price['min_charge']    = $_POST['min_charge_sq_cir'];
        $obj    = new Price($price);
        $result = $obj->update('id',$price['id']);
        if($result)
        {
            header('Location: /sticker-price-calculator/site/');
        }
        else
        {
            die("ERROR IN UPDATING RECORD");
        }
    }
}
else
{
    $price_id = $_POST['price_id'];
    if(empty($price_id))
    {
        //create
        $price['id']            = mt_rand(1000,9999);
        $price['width']         = $_POST['width_rec'];
        $price['height']        = $_POST['width_rec'];
        $price['price']         = $_POST['price_rec'];
        $price['quantity']      = $_POST['quantity_rec'];
        $price['min_charge']    = $_POST['min_charge_rec'];
        $obj    = new Price($price);
        $result = $obj->create();
        if($result) 
        {
            header('Location: /sticker-price-calculator/site/');
        }
        else
        {
            die("ERROR in CREATING RECORD");
        }
    }
    else
    {
        //EDIT
        $price['id']            = $_POST['price_id'];
        $price['width']         = $_POST['width_rec'];
        $price['height']        = $_POST['width_rec'];
        $price['price']         = $_POST['price_rec'];
        $price['quantity']      = $_POST['quantity_rec'];
        $price['min_charge']    = $_POST['min_charge_rec'];
        $obj    = new Price($price);
        $result = $obj->update('id',$price['id']);
        if($result)
        {
            header('Location: /sticker-price-calculator/site/');
        }
        else
        {
            die("ERROR IN UPDATING RECORD");
        }
    }
}