<?php
require_once('../private/initialize.php');
// $price['id'] = 124;
// $price['width'] = 52;
// $price['height'] = 52;
// $price['price'] = 42;
// $price['min_charge'] = 47;
// $obj = new Price($price);
// $result = $obj->update('id',$price['id']);
$prices = Price::select_with_order();
?>
<!doctype html>
<html lang="en">
<?php include '../private/shared/head.php' ?>

<body>

    <?php include '../private/shared/header.php' ?>
    <br>
    <br>
    <!-- Begin page content -->
    <main role="main" class="container">
        <a href="/sticker-price-calculator/site/create.php" target="_blank"><button class="btn btn-primary">Create New</button></a>
        <hr>
        
        <table id="data" class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Width
                    </th>
                    <th>
                        Height
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Min Charge
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($prices as $price) {
                    echo '<tr>' . PHP_EOL;
                    echo '<td>' . h($price['id']) . '</td>' . PHP_EOL;
                    echo '<td>' . h($price['width']) . '</td>' . PHP_EOL;
                    echo '<td>' . h($price['height']) . '</td>' . PHP_EOL;
                    echo '<td>' . h(number_format($price['price'], 2)) . '</td>' . PHP_EOL;
                    echo '<td>' . h($price['quantity']) . '</td>' . PHP_EOL;
                    echo '<td>' . h(number_format($price['min_charge'], 2)) . '</td>' . PHP_EOL;
                    echo '<td><a href="/sticker-price-calculator/site/edit.php?id=' .$price['id']. '"<button class="btn btn-success">Edit</button></a></td>' . PHP_EOL;
                    echo '</tr>' . PHP_EOL;
                }
                ?>
            </tbody>
        </table>
    </main>
    <br>
    <br>
    <?php include '../private/shared/footer.php' ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="_js/popper.min.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#data').DataTable();
        });
    </script>
</body>

</html>