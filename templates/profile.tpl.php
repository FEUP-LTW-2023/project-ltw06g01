<?php
require_once(__DIR__ . '/../classes/user.class.php');

function drawUserBox(PDO $db, User $user, bool $admin)
{ ?>
    <div class="user-box">
        <input type="hidden" name="id" class="uid" value=<?= $user->id ?>>
        <h3><?= $user->username ?></h3>
        <p><?= $user->email ?></p>
        <?php if ($user->level >= 1) {
            $departments = User::getAgentDepartments($db, $user->id); ?>
            <div class="user-departments">
                <?php foreach ($departments as $department) { ?>
                    <p><?= $department['department'] ?></p>
                <?php } ?>
            </div>
            <select name="departments" class="department-select"></select>
        <?php } ?>
        <?php if ($admin) ?> <input name="n" type="number" class="user-promotion-button" value=<?= $user->level ?> min="0" max="2" step="1"> <?php ; ?>
    <?php } ?>