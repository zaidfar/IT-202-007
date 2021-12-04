<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");
$item_id = (int)se($_POST, "item_id", 0, false);
//get the table definition
$result = [];
$columns = get_columns("Products");
//echo "<pre>" . var_export($columns, true) . "</pre>";
$ignore = ["id", "modified", "created"];
$db = getDB();
//get the item
$id = se($_GET, "id", -1, false);
$stmt = $db->prepare("SELECT * FROM Products where id =:id");
try {
    $stmt->execute([":id" => $id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $result = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}


function mapColumn($col)
{
    global $columns;
    foreach ($columns as $c) {
        if ($c["Field"] === $col) {
            return inputMap($c["Type"]);
        }
    }
    return "text";
}

?>
<div class="container-fluid">
   <h1> Product Detail <h1>
  <!--  <form method="POST"> -->
        <?php if(has_role("Admin")) :?>
            <a href="admin/edit_item.php?id=<?php se($_GET,'id'); ?> " >Edit</a>
            <?php endif;?>
        <?php foreach ($result as $column => $value) : ?> 
            <?php if ($column == "name"):  ?>
                <h5 class="body1">Name: <?php se($value, "name"); ?></h5>
                <?php endif; ?>
            <?php if ($column == "description"):  ?>
                <h5 class="body">Description: <?php se($value, "description"); ?></h5>
                <?php endif; ?>
            <?php if ($column == "category"):  ?>
                <h5 class="body">Category: <?php se($value, "category"); ?></h5>
                <?php endif; ?>
            <?php if ($column == "stock"):  ?>
                <h5 class="body">Stock: <?php se($value, "stock"); ?></h5>
                <?php endif; ?>
            <?php if ($column == "cost"):  ?>
                <h5 class="body">Cost: <?php se($value, "cost"); ?></h5>
                <?php endif; ?>

           <!-- DELETED <?php /* Lazily ignoring fields via hardcoded array*/ ?>
            <?php if (!in_array($column, $ignore)) : ?>
                <div class="mb-4">
                    <label class="form-label" for="<?php se($column); ?>"><?php se($column); ?></label>
                    <input class="form-control" id="<?php se($column); ?>" type="<?php echo mapColumn($column); ?>" value="<?php se($value); ?>" name="<?php se($column); ?>" />
                </div>
            <?php endif; ?>  DELETED -->
        <?php endforeach; ?>
       
  <!--  </form> -->
</div>

