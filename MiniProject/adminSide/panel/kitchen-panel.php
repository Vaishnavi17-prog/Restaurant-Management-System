<?php
include '../inc/dashHeader.php';
require_once '../config.php';
$query = "SELECT * FROM Kitchen WHERE time_ended IS NULL";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/pos.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2>Kitchen Panel</h2>
        <table class="table table-bordered">
            <thead>
                <a href="../posBackend/kitchenBackend/undo.php?UndoUnshow=true" class="btn btn-warning">Undo</a>
                <tr>
                    <th>Kitchen ID</th>
                    <th>Table ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Time Submitted</th>
                    <th>Time Ended</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $kitchen_id = $row['kitchen_id'];
                        $table_id = $row['table_id'];
                        $item_id = $row['item_id'];
                        $quantity = $row['quantity'];
                        $time_submitted = $row['time_submitted'];
                        $time_ended = $row['time_ended'];

                        // Get item name from Menu table
                        $itemQuery = "SELECT item_name FROM Menu WHERE item_id = '$item_id'";
                        $itemResult = mysqli_query($link, $itemQuery);
                        $itemRow = mysqli_fetch_assoc($itemResult);
                        $item_name = $itemRow['item_name'];

                        echo '<tr>';
                        echo '<td>' . $kitchen_id . '</td>';
                        echo '<td>' . $table_id . '</td>';
                        echo '<td>' . $item_name . '</td>';
                        echo '<td>' . $quantity . '</td>';
                        echo '<td>' . $time_submitted . '</td>';
                        echo '<td>' . ($time_ended ?: 'Not Ended') . '</td>';
                        echo '<td>';
                        if (!$time_ended) {
                            echo '<a href="../posBackend/kitchenBackend/kitchen-panel-back.php?action=set_time_ended&kitchen_id=' . $kitchen_id . '" class="btn btn-danger">Set Time Ended</a>';
                        }
                        
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No records in the Kitchen table.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
