<?php
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../database/departments.php');

function drawUserBox(PDO $db, User $user, bool $admin)
{ ?>
  <div class="user-box">
    <input type="hidden" name="id" class="uid" value=<?= $user->id ?>>
    <h3 id="name"><?= $user->username ?></h3>
    <p id="email"><?= $user->email ?></p>
    <?php if ($user->level >= 1) {
      $departments = User::getAgentDepartments($db, $user->id);
      $allDepartments =  getDepartments($db); ?>
      <div class="user-departments">
        <?php foreach ($departments as $department) { ?>
          <p id="departament"><?= $department ?></p>
        <?php } ?>
      </div>
      <?php if ($admin) { ?> <select name="departments" class="department-select">
          <?php foreach ($allDepartments as $allDepartment) { ?>
            <option value=<?= $allDepartment ?>><?= $allDepartment ?></option>
          <?php } ?>
        </select>
        <button type="button" class="toggle-button">Toggle</button> <?php }
                                                                } ?>
    <?php if ($admin) ?> <input name="n" type="number" class="user-promotion-button" value=<?= $user->level ?> min="0" max="2" step="1">
  </div>
<?php } ?>


<?php
function drawProfile($curr_user)
{
?>
  <div class="form-box-profile">
    <div id="image">
      <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div id="name">
      <ion-icon name="person-outline"></ion-icon>
      <label> <?php echo $curr_user['username']; ?> </label>
    </div>
    <div id="email">
      <ion-icon name="mail-outline"></ion-icon>
      <label> <?php echo $curr_user['email']; ?></label>
    </div>
    <div id="type">
      <ion-icon name="podium-outline"></ion-icon>
      <?php if ($curr_user['permissionLevel'] >= 1) : ?>
        <label for="level">Type: Agent</label>
      <?php elseif ($curr_user['permissionLevel'] == 2) : ?>
        <label for="level">Type: Admin</label>
      <?php else : ?>
        <label for="level">Type: Client</label>
      <?php endif; ?>
    </div>
  </div>
<?php
}
?>