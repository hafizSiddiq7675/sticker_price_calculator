<?php
require_once '../private/initialize.php';
// $number = 93;
// echo '<pre>'; print_r(ceil($number/100)*100); exit;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sticker Price Calculator</title>

    <!-- Bootstrap core CSS -->
    <link href="_css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="_css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="_css/custom.css" rel="stylesheet">
</head>

<body>

    <?php include '../private/shared/header.php' ?>

    <!-- Begin page content -->
    <main role="main" class="container">
        <form action="/action_page.php" id="price_cal_form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sticker_type">Please Select Sticker Type</label>
                        <select class="form-control" id="sticker_type" name="sticker_type">
                            <option value="0">-- Select Sticker Type --</option>
                            <option value="square_circle">Square / Circle</option>
                            <option value="ractangle">Ractangle</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id='height_width_div' style="display:none">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="height">Enter Height</label>
                            <input type="text" class="form-control" id="height_rec" placeholder="Enter Height" name="height_rec">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="width">Enter Width</label>
                            <input type="text" class="form-control" id="width_rec" placeholder="Enter Width" name="wdth_rec">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="width">Enter Quantity</label>
                            <input type="text" class="form-control" id="quantity_rec" placeholder="Enter Quantity" name="quantity_rec">
                            <span class="error">The minimum quantity is 50</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Enter Min Charge</label>
                            <input type="text" class="form-control" id="min_charge_rec" placeholder="Enter Min Charge" name="min_charge_rec">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="width">Enter Price Per Sq.m2</label>
                            <input type="text" class="form-control" id="price_rec" placeholder="Enter Price Per Sq.m2" name="price_rec">
                        </div>
                    </div>
                </div>
            </div>
            <div id="width_div" style="display:none">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Enter Width</label>
                            <input type="text" class="form-control" id="width_sq_cir" placeholder="Enter Width" name="width_sq_cir">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Enter Quantity</label>
                            <input type="text" class="form-control" id="quantity_sq_cir" placeholder="Enter Quantity" name="quantity_sq_cir">
                            <span class="error">The minimum quantity is 50</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Enter Min Charge</label>
                            <input type="text" class="form-control" id="min_charge_sq_cir" placeholder="Enter Min Charge" name="min_charge_sq_cir">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="width">Enter Price Per Sq.m2</label>
                            <input type="text" class="form-control" id="price_sq_cir" placeholder="Enter Price Per Sq.m2" name="price_sq_cir">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="cal_price">Calculate Price</button>
            <hr>
            <table class="table table-bordered cal-table">
                <thead>
                    <tr>
                        <th>widh with bleed (mm)</th>
                        <th>height with bleed (mm)</th>
                        <th>stickers per row</th>
                        <th>stikcer per row rounded</th>
                        <th>number of stickers</th>
                        <th>no of rows needed in mtr</th>
                        <th>height in mtr needed</th>
                        <th>price in total sq.m</th>
                        <th>price total inc min charge</th>
                    </tr>
                </thead>
                <tbody id="calculations">

                </tbody>
            </table>
            <center>
                <button type="submit" class="btn btn-success" id="savePrice" style="display:none">Save Price</button>
            </center>

        </form>
        </div>
    </main>


    <br>
    <br>

    <?php include '../private/shared/footer.php' ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="_js/popper.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/validate.js"></script>
    <script src="_js/stickerPage.js"></script>
</body>

</html>