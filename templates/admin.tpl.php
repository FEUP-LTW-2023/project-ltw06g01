<?php

function drawRemoveDepartment($department)
{ ?>
    <li>
        <form>
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" class="department-item" name="department" value=<?= $department ?>>
            <?= $department ?> <button type="submit" formmethod="post" formaction="../actions/delete_department.action.php">Delete</button>
        </form>
    </li>
<?php }

function drawRemoveStatus($status)
{ ?>
    <li>
        <form>
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" name="status" class="status-item" value=<?= $status ?>>
            <?= $status ?> <button type="submit" formmethod="post" formaction="../actions/delete_status.action.php" <?php if ($status == 'open' || $status == 'assigned' || $status == 'closed') echo 'disabled'; ?>>Delete</button>
        </form>
    </li>
<?php }

function drawAddDepartment()
{ ?>
    <form class="AddDepartment">
        <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input type="text" name="department" id="department-input">
        <button type="submit" formmethod="post" id="department-add" formaction="../actions/add_department.action.php">Add</button>
    </form>
<?php }

function drawAddStatus()
{ ?>
    <form class="AddStatus">
        <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input type="text" name="status" id="status-input">
        <button type="submit" formmethod="post" id="status-add" formaction="../actions/add_status.action.php">Add</button>
    </form>
<?php }
