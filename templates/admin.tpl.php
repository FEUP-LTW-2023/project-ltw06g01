<?php

function drawRemoveDepartment($department) { ?>
    <li>
        <?= $department ?> <button type="submit" formmethod="post" formaction="../actions/delete_department.action.php">Delete</button>
    </li>
<?php }

function drawRemoveStatus($status) { ?>
    <li>
        <?= $status ?> <button type="submit" formmethod="post" formaction="../actions/delete_status.action.php">Delete</button>
    </li>
<?php }

function drawAddDepartment() { ?>
    <form>
        <input type="text" name="department">
        <button type="submit" formmethod="post" formaction="../actions/add_department.php">Add</button>
    </form>
<?php }

function drawAddStatus() { ?>
    <form>
        <input type="text" name="status">
        <button type="submit" formmethod="post" formaction="../actions/add_status.php">Add</button>
    </form>
<?php }