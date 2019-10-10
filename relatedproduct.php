<?php
    session_start();

    if(isset($_POST["add"])){
        if(isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"], "product_id");
            if(!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_arrary = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_arrary;
                echo "<script>window.location=\"relatedproduct.php\"</script>";
            } else{
                echo "<script>alert(\"Product is already Added to Cart\")</script>";
                echo "<script>window.location=\"relatedproduct.php\"</script>";
            }
        } else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["cart"] as $keys => $value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo "<script>alert(\"Product has been Removed!\")</script>";
                    echo "<script>window.location=\"relatedproduct.php\"</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Plant A Tree online shope that sales New Zealand tree type.">
        <meta name="keywords" content="Plant A Tree, Tree shop, online tree shop">
        <meta name="author" content="Howard Zhu">
        <title>Plant A Tree - Related Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    
    <body>
        <header>
            <nav class="navbar pat-nav navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="./index.html"><h3>TreeCo</h3></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                      
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html"><h5>Home</h5><span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="treeshop.php"><h5>Tree</h5></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="relatedproduct.php"><h5>Related Product</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html"><h5>About</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html"><h5>Contact</h5></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="relatedproduct">
            <h1 class="text-center">Related Product</h1>
        </div>
        
        <?php
            $conn = @mysqli_connect("us-cdbr-iron-east-05.cleardb.net", "ba4be300989f85", "685a4ee7", "heroku_6479816064ccda3");

            if (!$conn) {
                // Displays an error message
                echo "<p>Database connection failure</p>\n";
            } else {
                $query = "SELECT * FROM related_prod";
                $result = mysqli_query($conn, $query);

                if(!$result)
                echo "<p>Something is wrong with ",	$query, "</p>\n";
                else{
                    echo "<div class=\"container\">\n";
                        echo "<div class=\"row\">\n";
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<form method=\"POST\" action=\"relatedproduct.php?action=add&id=".$row["id"]."\" class=\"item-padding col-lg-3 col-sm-12\" align=\"center\">\n";
                                    echo "<div class=\"col-12 card\" align=\"center\" style=\"width: 18rem;\">\n";
                                        echo "<img src=\"./treeinfor/".$row["category"]."-".$row["category_id"].".jpg\" class=\"card-img-top\" alt=\"...\">\n";
                                        echo "<div class=\"card-body\">\n";
                                            echo "<h5 class=\"card-title black\">".$row["name"]."</h5>\n";
                                            echo "<p class=\"card-text black\">".$row["description"]."</p><hr>\n";
                                            echo "<p class=\"card-text black\">Quantity:<input type=\"text\" name=\"quantity\" class=\"form-control  text-center\" value=\"1\"></p><hr>\n";
                                            echo "<p class=\"card-text black\">$".$row["price_range"]."</p>\n";
                                            echo "<input type=\"hidden\" name=\"hidden_name\" value=\"".$row["name"]."\">\n";
                                            echo "<input type=\"hidden\" name=\"hidden_price\" value=\"".$row["price_range"]."\">\n";
                                            echo "<input type=\"submit\" name=\"add\" class=\"btn btn-primary\" value=\"Add to Cart\">\n";
                                        echo "</div>\n";
                                    echo "</div>\n";
                                echo "</form>\n";
                            }
                        echo "</div>\n";
                    echo "</div>\n";
                }
            }
        ?>
            
        <h1 class="text-center">Shopping Cart</h1>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Remove Item</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($_SESSION["cart"])){
                        $total = 0;
                        foreach($_SESSION["cart"] as $key => $value){
                            $p_total = number_format($value["item_quantity"]*$value["product_price"], 2);
                            echo "<tr>";
                                echo "<th>".$value["item_name"]."</th>";
                                echo "<td>$".$value["product_price"]."</td>";
                                echo "<td>".$value["item_quantity"]."</td>";
                                echo "<td><a href=\"relatedproduct.php?action=delete&id=".$value["product_id"]."\"><span class=\"text-danger\">Remove Item</span></a></td>";
                                echo "<td>$".$p_total."</td>";
                            echo "</tr>";

                            $total = $total + ($value["item_quantity"]*$value["product_price"]);
                        }

                        $f_total = number_format($total, 2);
                        $val = 20.00;

                        echo "<tr>";
                            echo "<td colspan=\"4\" align=\"right\">Shippment：
                                <select name=\"shippment\">
                                    <option>Auckland</option>
                                    <option>North Island</option>
                                    <option>South Island</option>
                                    <option>Pick Up</option>
                                </select>
                            </td>";

                            echo "<th aligh=\"right\">$".$val."</th>";
                        echo "</tr>";

                        $f_total += $val;

                        echo "<tr>";
                            echo "<td colspan=\"4\" align=\"right\">Total</td>";
                            echo "<th aligh=\"right\">$".$f_total."</th>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td colspan=\"4\"></td>";
                            echo "<th align=\"left\"><a class=\"btn btn-primary\" href=\"#\">Pay</a></th>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        
        <footer>
            <nav class="navbar pat-nav navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="./index.html"><h3>TreeCo</h3></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html"><h5>Home</h5><span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="treeshop.php"><h5>Tree</h5></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="relatedproduct.php"><h5>Related Product</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html"><h5>About</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html"><h5>Contact</h5></a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-text">
                    <h5><img src="./img/copyright.png" class="png">TreeCo Company 2019</h5>
                </div>
                <div class="clearfix"></div>
            </nav>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
