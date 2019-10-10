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
                echo "<script>window.location=\"treeshop.php\"</script>";
            } else{
                echo "<script>alert(\"Product is already Added to Cart\")</script>";
                echo "<script>window.location=\"treeshop.php\"</script>";
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
                    echo "<script>window.location=\"treeshop.php\"</script>";
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
        <title>Plant A Tree - Tree Shop</title>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="treeshop.php"><h5>Tree</h5></a>
                        </li>
                        <li class="nav-item">
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

        <nav class="navbar pat-nav navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="./index.html"><h4>Tree Category</h4></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                  
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p>Tree Category</br>
                                <select class="category-bar" name="treeCategory" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="fruit tree">Fruit tree</option>
                                    <option value="hedge">Hedge</option>
                                    <option value="evergreen">Evergreen</option>
                                    <option value="nz native">NZ native</option>
                                    <option value="gum green">Gum green</option>
                                    <option value="palm tree">Palm tree</option>
                                    <option value="hardwood">Hardwood</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p class="align-middle">Soil Drainage</br>
                                <select class="category-bar" name="soilDrainage" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="fast">Fast</option>
                                    <option value="medium">Medium</option>
                                    <option value="slow">Slow</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p>Sunshine Require</br>
                                <select class="category-bar" name="sunshineRequire" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="sunny">Sunny</option>
                                    <option value="medium">Medium</option>
                                    <option value="shade">Shade</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p>Maintenance Requirements</br>
                                <select class="category-bar" name="maintenanceRequirements" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="slow">Low</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p>Max height</br>
                                <select class="category-bar" name="maxHeight" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="<1">< 1m</option>
                                    <option value="BETWEEN 1 AND 2">1 - 2m</option>
                                    <option value="BETWEEN 2 AND 3">2 - 3m</option>
                                    <option value=">3">> 3m</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="category-nav-item text-center">
                            <p>Growth Rate<br/>
                                <select class="category-bar" name="growthRate" form="cartform">
                                    <option value="any">Any</option>
                                    <option value="fast">Fast</option>
                                    <option value="medium">Medium</option>
                                    <option value="slow">Slow</option>
                                </select>
                            </p>
                        </div>
                    </li>
                    <form method="POST" id="cartform">
                        <li class="nav-item">
                            <div class="category-nav-item text-center">
                                <p>Price Range</br>
                                    <div class="price-form">
                                        <p>
                                            <input type="text" name="priceOne" placeholder="Any">
                                        to
                                            <input type="text" name="priceTwo" placeholder="Any">
                                        </p>
                                    </div>
                                </p>
                            </div>
                        </li>
                        <li class="nav-item text-center">
                            <div class="category-nav-submit">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </li>
                    </form>
                </ul>
            </div>
        </nav>

        <?php
            $conn = @mysqli_connect("us-cdbr-iron-east-05.cleardb.net", "ba4be300989f85", "685a4ee7", "heroku_6479816064ccda3");

            if (!$conn) {
                // Displays an error message
                echo "<p>Database connection failure</p>\n";
            } else {
                if(isset($_POST["treeCategory"])){
                    $treeCategory=$_POST["treeCategory"];
                    if($treeCategory == 'any'){
                        $treeCategory = null;
                    }
                }else{
                    $treeCategory = null;
                }

                if(isset($_POST["soilDrainage"])){
                    $soilDrainage=$_POST["soilDrainage"];
                    if($soilDrainage == 'any'){
                        $soilDrainage = null;
                    }
                }else{
                    $soilDrainage = null;
                }

                if(isset($_POST["sunshineRequire"])){
                    $sunshineRequire=$_POST["sunshineRequire"];
                    if($sunshineRequire == 'any'){
                        $sunshineRequire = null;
                    }
                }else{
                    $sunshineRequire = null;
                }

                if(isset($_POST["maintenanceRequirements"])){
                    $maintenanceRequirements=$_POST["maintenanceRequirements"];
                    if($maintenanceRequirements == 'any'){
                        $maintenanceRequirements = null;
                    }
                }else{
                    $maintenanceRequirements = null;
                }

                if(isset($_POST["maxHeight"])){
                    $maxHeight="".$_POST["maxHeight"];
                    if($maxHeight == 'any'){
                        $maxHeight = null;
                    }
                }else{
                    $maxHeight = null;
                }

                if(isset($_POST["growthRate"])){
                    $growthRate=$_POST["growthRate"];
                    if($growthRate == 'any'){
                        $growthRate = null;
                    }
                }else{
                    $growthRate = null;
                }

                if(isset($_POST["priceOne"])){
                    $priceOne=$_POST["priceOne"];
                    if($priceOne == ''){
                        $priceOne = null;
                    }
                }else{
                    $priceOne = null;
                }

                if(isset($_POST["priceTwo"])){
                    $priceTwo=$_POST["priceTwo"];
                    if($priceTwo == ''){
                        $priceTwo = null;
                    }
                }else{
                    $priceTwo = null;
                }
                
                if($treeCategory==null && $soilDrainage==null && $sunshineRequire==null && $maintenanceRequirements==null &&
                    $maxHeight==null && $growthRate==null && $priceOne==null && $priceTwo==null){
                    $query = "SELECT * FROM tree_infor";
                    $result = mysqli_query($conn, $query);

                    if(!$result)
                    echo "<p>Something is wrong with ",	$query, "</p>\n";
                    else{
                        echo "<div class=\"container\">\n";
                            echo "<div class=\"row\">\n";
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<form method=\"POST\" action=\"treeshop.php?action=add&id=".$row["id"]."\" class=\"item-padding col-lg-3 col-sm-12\" align=\"center\">\n";
                                        echo "<div class=\"col-12 card\" align=\"center\" style=\"width: 18rem;\">\n";
                                            echo "<img src=\"./treeinfor/".$row["category"]."-".$row["category_id"].".jpg\" class=\"card-img-top\" alt=\"...\">\n";
                                            echo "<div class=\"card-body\">\n";
                                                echo "<h5 class=\"card-title black\">".$row["name"]."</h5>\n";
                                                echo "<p class=\"card-text black\">".$row["description"]."</p><hr>\n";
                                                echo "<p class=\"card-text black\">Max Height: ".$row["max_height"]."m</p><hr>\n";
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
                } else{
                    $query = "SELECT * FROM tree_infor WHERE ";
                    $search = "You search for ";
                    $addTimes = 0;

                    if($treeCategory!=null){
                        $query = $query."category LIKE '".$treeCategory."'";
                        $search = $search."[Category: ".$treeCategory."]";
                        $addTimes++;
                    }

                    if($soilDrainage!=null){
                        if($addTimes>0){
                            $query = $query." AND soil_drainage LIKE '".$soilDrainage."'";
                            $search = $search." and [Soil drainage: ".$soilDrainage."]";
                        }
                        else{
                            $query = $query."soil_drainage LIKE '".$soilDrainage."'";
                            $search = $search."[Soil drainage: ".$soilDrainage."]";
                        }
                        $addTimes++;
                    }

                    if($sunshineRequire!=null){
                        if($addTimes>0){
                            $query = $query." AND sunshine_require LIKE '".$sunshineRequire."'";
                            $search = $search." and [Sunshine require: ".$sunshineRequire."]";
                        }
                        else{
                            $query = $query."sunshine_require LIKE '".$sunshineRequire."'";
                            $search = $search."[Sunshine require: ".$sunshineRequire."]";
                        }
                        $addTimes++;
                    }

                    if($maintenanceRequirements!=null){
                        if($addTimes>0){
                            $query = $query." AND maintenance_requirements LIKE '".$maintenanceRequirements."'";
                            $search = $search." and [Maintenance requirements: ".$maintenanceRequirements."]";
                        }
                        else{
                            $query = $query."maintenance_requirements LIKE '".$maintenanceRequirements."'";
                            $search = $search."[Maintenance requirements: ".$maintenanceRequirements."]";
                        }
                        $addTimes++;
                    }

                    if($maxHeight!=null){
                        if($addTimes>0){
                            $query = $query." AND max_height ".$maxHeight;
                            $search = $search." and [Max height: ".$maxHeight."]";
                        }
                        else{
                            $query = $query."max_height ".$maxHeight;
                            $search = $search."[Max height: ".$maxHeight."]";
                        }
                        $addTimes++;
                    }

                    if($growthRate!=null){
                        if($addTimes>0){
                            $query = $query." AND growth_rate LIKE '".$growthRate."'";
                            $search = $search." and [Growth rate: ".$growthRate."]";
                        }
                        else{
                            $query = $query."growth_rate LIKE '".$growthRate."'";
                            $search = $search."[Growth rate: ".$growthRate."]";
                        }
                        $addTimes++;
                    }

                    if($priceOne!=null && $priceTwo!=null){
                        if($addTimes>0){
                            $query = $query." AND price_range BETWEEN ".$priceOne." AND ".$priceTwo;
                            $search = $search." and [Price range: Between ".$priceOne." and ".$priceTwo."]";
                        }
                        else{
                            $query = $query."price_range BETWEEN ".$priceOne." AND ".$priceTwo;
                            $search = $search."[Price range: Between ".$priceOne." and ".$priceTwo."]";
                        }
                        $addTimes++;
                    } elseif($priceOne!=null){
                        if($addTimes>0){
                            $query = $query." AND price_range >= ".$priceOne;
                            $search = $search." and [Price range: Greater or equal to ".$priceOne."]";
                        }
                        else{
                            $query = $query."price_range >= ".$priceOne;
                            $search = $search."[Price range: Greater or equal to ".$priceOne."]";
                        }
                        $addTimes++;
                    } elseif($priceTwo!=null){
                        if($addTimes>0){
                            $query = $query." AND price_range <= ".$priceTwo;
                            $search = $search." and [Price range: Less or equal to ".$priceTwo."]";
                        }
                        else{
                            $query = $query."price_range <= ".$priceTwo;
                            $search = $search."[Price range: Less or equal to ".$priceTwo."]";
                        }
                        $addTimes++;
                    }

                    $result = mysqli_query($conn, $query);
                    if(!$result) {
                        echo "<p>Something is wrong with ",	$query, "</p>";
                    } else {
                        $addTimes=0;
                        echo "<div class=\"container\">\n";
                            echo "<div class=\"row\">\n";
                            echo "<h2 class=\"col-lg-12 text-center\">".$search."</h2>";
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<form class=\"item-padding col-lg-3\" align=\"center\">\n";
                                        echo "<div class=\"col-10 card\" style=\"width: 18rem;\">\n";
                                            echo "<img src=\"./treeinfor/".$row["category"]."-".$row["category_id"].".jpg\" class=\"card-img-top\" alt=\"...\">\n";
                                            echo "<div class=\"card-body\">\n";
                                                echo "<h5 class=\"card-title black\">".$row["name"]."</h5>\n";
                                                echo "<p class=\"card-text black\">".$row["description"]."</p><hr>\n";
                                                echo "<p class=\"card-text black\">Max Height: ".$row["max_height"]."m</p><hr>\n";
                                                echo "<input type=\"text\" name=\"quantity\" class=\"form-control text-center\" value=\"1\"><hr>\n";
                                                echo "<p class=\"card-text black\">$".$row["price_range"]."</p>\n";
                                                echo "<input type=\"hidden\" name=\"hidden_name\" value=\"".$row["name"]."\"><hr>\n";
                                                echo "<input type=\"hidden\" name=\"hidden_price\" value=\"".$row["price_range"]."\"><hr>\n";
                                                echo "<input type=\"submit\" name=\"add\" class=\"btn btn-primary\" value=\"Add to Cart\">\n";
                                            echo "</div>\n";
                                        echo "</div>\n";
                                    echo "</form>\n";
                                }

                                if($addTimes==0){
                                    echo "<h1 class=\"col-lg-12 text-center\">No Match Product</h1>";
                                }
                            echo "</div>\n";
                        echo "</div>\n";
                    }
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
                                echo "<td><a href=\"treeshop.php?action=delete&id=".$value["product_id"]."\"><span class=\"text-danger\">Remove Item</span></a></td>";
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
                        <li class="nav-item  active">
                            <a class="nav-link" href="treeshop.php"><h5>Tree</h5></a>
                        </li>
                        <li class="nav-item">
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