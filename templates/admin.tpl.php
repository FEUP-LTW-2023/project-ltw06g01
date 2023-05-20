<?php

function drawRemoveDepartment($department)
{ ?>
    <li>
        <form>
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" name="department" value=<?= $department ?>>
            <?= $department ?> <button type="submit" formmethod="post" formaction="../actions/delete_department.action.php">Delete</button>
        </form>
    </li>
<?php }

function drawRemoveStatus($status)
{ ?>
    <li>
        <form>
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" name="status" value=<?= $status ?>>
            <?= $status ?> <button type="submit" formmethod="post" formaction="../actions/delete_status.action.php" <?php if ($status == 'open' || $status == 'assigned' || $status == 'cloesd') echo 'disabled'; ?>>Delete</button>
        </form>
    </li>
<?php }

function drawAddDepartment()
{ ?>
    <form>
        <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input type="text" name="department">
        <button type="submit" formmethod="post" formaction="../actions/add_department.action.php">Add</button>
    </form>
<?php }

function drawAddStatus()
{ ?>
    <form>
        <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input type="text" name="status">
        <button type="submit" formmethod="post" formaction="../actions/add_status.action.php">Add</button>
    </form>
<?php }
