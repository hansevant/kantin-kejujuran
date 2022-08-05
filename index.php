<?php include "connection.php" ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kantin Kejujuran</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="bg-danger bg-gradient pt-5">

    <main>
        <div class="col-lg-6  mx-auto my-0 p-2">
            <div class="card main-card">
                <h2 class="text-center mt-3">Kantin Kejujuran</h2>

                <div class="row p-3 justify-content-center">
                    <div class="col-3 d-grid">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal1">Sell Item 🛒</button>
                    </div>
                    <div class="col-3 d-grid">
                        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            Balance 💰
                        </button>
                    </div>
                    <div class="col-3 d-grid  ">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./?name=name">Name</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./?date=date">Date</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 justify-content-center">
                    <div class="col-10">

                        <!-- Filter / Sorting Products -->
                        <?php

                        if (isset($_GET["name"])) {
                            $queries = mysqli_query($conn, "SELECT * FROM products WHERE product_sold = 0 ORDER BY product_name ASC");
                        } elseif (isset($_GET["date"])) {
                            $queries = mysqli_query($conn, "SELECT * FROM products WHERE product_sold = 0 ORDER BY created_at ASC");
                        } else {
                            $queries = mysqli_query($conn, "SELECT * FROM products WHERE product_sold = 0");
                        }

                        if ($queries->num_rows > 0) {
                            while ($data = mysqli_fetch_array($queries)) {
                                // formatting prices
                                $formatted = number_format($data['product_price'], 0, '.', ',');
                                $prefix = 'Rp. ';
                                $suffix = '.00';
                                $balance = $prefix . $formatted . $suffix;

                                $date = date('j M Y g:i A', strtotime($data['created_at']));
                        ?>

                                <div class="card mt-3">
                                    <div class=" row g-0">
                                        <div class="col-4">
                                            <img src="imgs/<?= $data['product_image'] ?>" alt="Product Image" class="img-fluid rounded-start product-img">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $data['product_name'] ?></h5>
                                                <p class="card-text"><?= $data['product_description'] ?></p>
                                                <p class="card-text fw-semibold text-danger"><?= $balance ?></p>
                                                <p class="card-text"><small class="text-muted">Added at <?= $date ?></small></p>
                                                <a href="functions/buy.php?id=<?= $data['product_id'] ?>">
                                                    <button class="btn btn-warning btn-sm float-end mb-3 fw-semibold" onclick="alert('Berhasil Membeli')">Buy this item</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php }
                        } else {
                            echo "0 results";
                        } ?>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Modal 1 -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sell some item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/sell.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Name of Product</label>
                            <input type="text" class="form-control" id="exampleFormControlInput2" required name="name">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image <span class="text-muted">1x1</span></label>
                            <input class="form-control" type="file" id="formFile" required name="image">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Description</label>
                            <input type="text" class="form-control" id="exampleFormControlInput3" required name="desc">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Price</label>
                            <input type="number" class="form-control" id="exampleFormControlInput4" required name="price">
                        </div>
                        <button class="btn btn-danger btn-sell float-end" type="submit" name="submit">Sell</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Canteen Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    // formatting price
                    $sql = "SELECT balance FROM balance_box WHERE id = 1";
                    $result = $conn->query($sql);
                    $data = $result->fetch_column();
                    $formatted = number_format($data, 0, '.', ',');
                    $prefix = 'Rp. ';
                    $suffix = '.00';
                    $balance = $prefix . $formatted . $suffix;
                    ?>
                    <h1>
                        <?= $balance ?>
                    </h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="functions/deposite.php">
                                <div class="mb-3">
                                    <label for="deposite" class="form-label">Add the Canteen Balance</label>
                                    <input type="number" required class="form-control" id="deposite" name="deposite" aria-describedby="depo">
                                    <div id="depo" class="form-text">Maximum amount is unlimited.
                                        <br><br><br>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" name="submit">Deposite</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="functions/withdraw.php">
                                <div class="mb-3">
                                    <label for="withdraw" class="form-label">Withdraw the Canteen Balance</label>
                                    <input type="number" required class="form-control" id="withdraw" name="withdraw" aria-describedby="tarik">
                                    <div id="tarik" class="form-text">The maximum amount can be withdrawn canteen's current balance.</div>
                                </div>
                                <button class="btn btn-danger" type="submit" name="submit">Withdraw</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>