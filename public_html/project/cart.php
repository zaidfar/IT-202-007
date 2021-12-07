<?php

//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");


$db = getDB();
$results = [];
if (!isset($user_id)) {
    $user_id = get_user_id();
}
error_log("inventory");
$stmt = $db->prepare("SELECT products.id, name, unit_cost, desired_quantity FROM Cart carts JOIN Products products on carts.item_id = products.id WHERE carts.user_id = :uid");
try {
    $stmt->execute([":uid" => $user_id]);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("<pre>" . var_export($e, true) . "</pre>");
}
//TODO
//display inventory output
//allow triggering effects for next game session
//store triggered items in a new table (so it persists between page loads and logouts)
?>
<h5>Cart</h5>

<div class="row row-cols-auto g-4 justify-content-center">
    <?php foreach ($results as $r) : ?>
        <div class="col ">
            <div class="card bg-dark " style="width:153px; height:153px">
                <div class="card-body">
                    <div class="card-text"><?php se($r, "name"); ?></div>
                </div>
                <div class="card-body">
                    <div class="card-text"><?php se($r, "unit_price"); ?></div>
                </div>
                <div class="card-footer">
                    <div class="text-center mb-3">
                        <div class="desired_quantity">
                            <?php se($r, "desired_quantity", 0); ?>x
                        </div>
                    </div> 
                    <!--<div class="d-grid gap-2">
                        <button class="btn btn-primary" onclick="activate_item(<?php se($r, 'id'); ?>, this)">Use</button>
                    </div> -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>