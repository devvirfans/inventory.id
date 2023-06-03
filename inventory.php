<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // Redirect to the sign-in page or any other appropriate action
  header('Location: sign-in.php');
  exit();
}

// Retrieve user information from the database
$username = $_SESSION['username'];
$query = "SELECT s.store_id, s.store_name, i.inventory_id, i.product_id, i.quantity, p.product_name, p.product_price, p.product_desc
          FROM store AS s
          LEFT JOIN inventory AS i ON s.store_id = i.store_id
          LEFT JOIN product AS p ON i.product_id = p.product_id
          WHERE s.user_id = (SELECT user_id FROM users WHERE username = '$username')";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Create an empty array to store the store data
    $stores = array();

    // Fetch store and product data
    // Fetch store and product data
    while ($row = mysqli_fetch_assoc($result)) {
        $storeid = $row['store_id'];
        $storename = $row['store_name'];

        // Check if the store exists in the stores array
        if (!isset($stores[$storeid])) {
            // Create an empty array for products of the current store
            $stores[$storeid] = array(
                'storename' => $storename,
                'storeid' => $storeid, // Add store ID as an attribute
                'products' => array()
            );
        }

        // Check if the current row has product data
        if ($row['product_id'] != null) {
            $inventoryid = $row['inventory_id'];
            $productid = $row['product_id'];
            $quantity = $row['quantity'];
            $productname = $row['product_name'];
            $productprice = $row['product_price'];
            $productdesc = $row['product_desc'];

            // Add the product data to the products array of the current store
            $stores[$storeid]['products'][] = array(
                'inventoryid' => $inventoryid,
                'productid' => $productid,
                'quantity' => $quantity,
                'productname' => $productname,
                'productprice' => $productprice,
                'productdesc' => $productdesc
            );
        }
    }
} else {
    // No inventory data found
    $stores = array(); // Initialize $stores as an empty array
}


if (empty($stores)) {
    echo "No inventory data found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $storeId = $_POST['store_id'];
    $newProductNames = $_POST['new_product_name'];
    $newProductPrices = $_POST['new_product_price'];
    $newQuantities = $_POST['new_quantity'];

    // Check if the store_id exists in the store table
    $checkStoreQuery = "SELECT * FROM store WHERE store_id = '$storeId'";
    $checkStoreResult = mysqli_query($connection, $checkStoreQuery);

    if (mysqli_num_rows($checkStoreResult) > 0) {
        // Iterate over the new items and insert them into the database
        foreach ($newProductNames as $index => $newProductName) {
            $newProductPrice = $newProductPrices[$index];
            $newQuantity = $newQuantities[$index];

            // Insert the new product into the product table
            $insertProductQuery = "INSERT INTO product (product_name, product_price)
                                   VALUES ('$newProductName', '$newProductPrice')";
            $insertProductResult = mysqli_query($connection, $insertProductQuery);

            if ($insertProductResult) {
                // Retrieve the generated product_id
                $productId = mysqli_insert_id($connection);

                // Insert the product_id and store_id into the inventory table
                $insertInventoryQuery = "INSERT INTO inventory (product_id, quantity, store_id)
                                         VALUES ('$productId', '$newQuantity', '$storeId')";
                $insertInventoryResult = mysqli_query($connection, $insertInventoryQuery);

                if ($insertInventoryResult) {
                    // Item successfully added to all tables
                    // Redirect to the same page to refresh the inventory display
                    header('Location: inventory.php');
                    exit();
                } else {
                    echo "Error inserting into inventory table: " . mysqli_error($connection);
                }
            } else {
                echo "Error inserting into product table: " . mysqli_error($connection);
            }
        }
    } else {
        echo "Invalid store_id: " . $storeId;
    }
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_store'])) {
    $newStoreName = $_POST['new_store_name'];

    // Insert the new store into the store table
    $insertStoreQuery = "INSERT INTO store (store_name, user_id)
                         VALUES ('$newStoreName', (SELECT user_id FROM users WHERE username = '$username'))";
    $insertStoreResult = mysqli_query($connection, $insertStoreQuery);

    if ($insertStoreResult) {
        // Store successfully added
        // Redirect to the same page to refresh the store display
        header('Location: inventory.php');
        exit();
    } else {
        echo "Error inserting into store table: " . mysqli_error($connection);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $storeId = $_POST['store_id'];
    $inventoryId = $_POST['inventory_id'];

    // Check if the store_id and inventory_id exist in the database
    $checkInventoryQuery = "SELECT * FROM inventory WHERE inventory_id = '$inventoryId' AND store_id = '$storeId'";
    $checkInventoryResult = mysqli_query($connection, $checkInventoryQuery);

    if (mysqli_num_rows($checkInventoryResult) > 0) {
        // Delete the product from the inventory table
        $deleteInventoryQuery = "DELETE FROM inventory WHERE inventory_id = '$inventoryId'";
        $deleteInventoryResult = mysqli_query($connection, $deleteInventoryQuery);

        if ($deleteInventoryResult) {
            // Product successfully deleted
            // Redirect to the same page to refresh the inventory display
            header('Location: inventory.php');
            exit();
        } else {
            echo "Error deleting from inventory table: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid store_id or inventory_id: " . $storeId . " - " . $inventoryId;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_store'])) {
    $storeId = $_POST['store_id'];

    // Check if the store_id exists in the store table
    $checkStoreQuery = "SELECT * FROM store WHERE store_id = '$storeId'";
    $checkStoreResult = mysqli_query($connection, $checkStoreQuery);

    if (mysqli_num_rows($checkStoreResult) > 0) {
        // Delete the store from the store table
        $deleteStoreQuery = "DELETE FROM store WHERE store_id = '$storeId'";
        $deleteStoreResult = mysqli_query($connection, $deleteStoreQuery);

        if ($deleteStoreResult) {
            // Store successfully deleted
            // Redirect to the same page to refresh the store display
            header('Location: inventory.php');
            exit();
        } else {
            echo "Error deleting from store table: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid store_id: " . $storeId;
    }
}



// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
<style>
        /* Styling for the dropdown */
        .dropdown-content {
            display: none;
        }
        
        .dropdown-toggle:hover .dropdown-content {
            display: block;
        }
        
        /* Other styles */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        .store-name {
            font-weight: bold;
            cursor: pointer;
        }
        
        .add-store-row {
            text-align: right;
            background-color: orange;
            color: white;
            font-weight: bold;
            padding: 8px;
        }
        
        .add-store-row a {
            color: white;
            text-decoration: none;
            margin-right: 5px;
        }
        store1
        .dropdown-icon {
            margin-right: 5px;
        }
        
        /* Added styles */
        .add-store-form td {
            padding: 8px 0;
        }
        
        .add-item-form td {
            padding: 8px 0;
        }
        /* Updated styles */
        .store-title-row {
            width: 100%;
        }
</style>    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link href="./inventory.css" rel="stylesheet" />
</head>
<body>
    <div class="inventory-container">
        <div class="inventory-inventory-system">
          <div class="inventory-heading">
            <img
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/3b2c42ff-4602-44fd-98a1-d3077f186c9f/6a11e003-dbfb-44b8-b76a-c7c0139ccf39?org_if_sml=14475"
              alt="logo3764"
              class="inventory-logo"
            />
            <a class="inventory-text" href="home.php"><span>Home</span></a>
            <a class="inventory-text2" href="inventory.php"><span>Inventory</span></a>
            <a class="inventory-text4" href="profile.php"><span>Profile</span></a>
            <a class="inventory-text6" href="sign-in.php"><span>Log Out</span></a>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr >
                        <th colspan="7" class="store-title">Store Name</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($stores as $storeid => $store): ?>
        <tr class="store rounded-tr">
            <td class="store-name" onclick="toggleDropdown('store<?php echo $storeid; ?>')">
                <span class="dropdown-icon">▼</span>
                <?php echo $store['storename']; ?>
            </td>
            <td class="store-delete">
                <form method="POST" action="">
                    <input type="hidden" name="store_id" value="<?php echo $storeid; ?>">
                    <input type="submit" value="Delete" name="delete_store">
                </form>
            </td>
        </tr>
        <tr class="store-dropdown">
            <td class="store-dropdown-container">
                <div id="store<?php echo $storeid; ?>" class="dropdown-content">
                    <table>
                        <thead class="store-title-row">
                            <tr class="store-title-row">
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="store-body">
                        <?php foreach ($store['products'] as $index => $product): ?>
                            <tr>
                                <form method="POST" action="">
                                    <input type="hidden" name="store_id" value="<?php echo $storeid; ?>">
                                    <input type="hidden" name="inventory_id" value="<?php echo $product['inventoryid']; ?>"> <!-- Add the inventory ID as a hidden input field -->
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $product['productname']; ?></td>
                                    <td>Rp. <?php echo $product['productprice']; ?>,00</td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td>
                                        <input type="submit" value="Delete" name="delete_item"> <!-- Add the delete button -->
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                            <tr class="add-item-row">
                                <td colspan="5" style="text-align: right">
                                    <a href="#" onclick="showAddItemForm(<?php echo $storeid; ?>)">Add a new item</a>
                                    <span class="add-store-icon">+</span>
                                </td>
                            </tr>
                            <tr class="add-item-form" id="add-item-form-<?php echo $store['storeid']; ?>" style="display: none;">
                                <form method="POST" action="">
                                    <input type="hidden" name="store_id" value="<?php echo $storeid; ?>">
                                    <td></td>
                                    <td><input type="text" name="new_product_name[]" placeholder="Product Name"/></td>
                                    <td><input type="number" name="new_product_price[]" placeholder="Product Price"/></td>
                                    <td><input type="number" name="new_quantity[]" placeholder="Quantity"/></td>
                                    <td><input type="submit" value="Add" name="add_item"></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr class="add-store-row">
    <td colspan="7" style="text-align: right" class="add-store">
        <a href="#" onclick="showAddStoreForm()">Add a new store</a>
        <span class="add-store-icon">+</span>
    </td>
</tr>
<tr class="add-store-form" id="add-store-form" style="display: none;">
    <form method="POST" action="">
        <td colspan="4">
            <input type="text" name="new_store_name" placeholder="Store Name"/>
        </td>
        <td colspan="2">
            <input type="submit" value="Add" name="add_store">
        </td>
    </form>
</tr>
</tbody>
            </table>
        </div>
    </div>


    <script>
    // Function to toggle the visibility of the dropdown
    function toggleDropdown(id) {
        var dropdown = document.getElementById(id);
        if (dropdown.style.display === 'none') {
        dropdown.style.display = 'block';
        } else {
        dropdown.style.display = 'none';
        }
    }

    // Function to show the add item form
    function showAddItemForm(storeId) {
        var form = document.getElementById('add-item-form-' + storeId);
        form.style.display = 'table-row';
    }
    function showAddStoreForm() {
    var form = document.getElementById('add-store-form');
    form.style.display = 'table';
}

</script>
</body>
</html>