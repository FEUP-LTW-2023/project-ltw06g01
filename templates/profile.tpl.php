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
          <p class="department"><?= $department ?></p>
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
  <div class="form-box-profile" id = "profile_box">
    <div id="edit">
      <ion-icon name="hammer-outline"></ion-icon>
    </div> 
    <div id="name">
      <label> <?php echo $curr_user['username']; ?> </label>
    </div>   
    <div id="image">
      <ion-icon name="person-circle-outline"></ion-icon>
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

<?php
function drawProfileEdit($curr_user)
{
?>
  <div class="form-box-edit-profile" id = "profile-edit">
  <form>
    <div id ="back">
      <ion-icon name="close-outline"></ion-icon>
    </div>
    <div id="image">
      <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div id="name">
      <input type="text"  required id = "username" name="username" value="<?php echo $curr_user['username']; ?>" />
    </div>
    <div id="email">
      <input type="email" required id = "email-text" name="email" value="<?php echo $curr_user['email']; ?>" />
    </div>
    <div id = "save">
      <button type="submit" class="submit-update" formaction="/../actions/updating_profile.php" formmethod="post">Save</button>
    </div>
  </form>
  </div>
<?php
}
?>