<?php
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../database/departments.php');

function drawUserBox(PDO $db, User $user)
{ ?>
  <div class="backdrop" id="backdrop"></div>
  <div class="user-box" id="userBox-<?= $user->id ?>" onclick="toggleUserBoxPopup(<?= $user->id ?>)">
  <h3 id="name"><?= $user->username ?></h3>
  <p id="email"><?= $user->email ?></p>
</div>
<div class="user-box-popup" id="userBoxPopup-<?= $user->id ?>">
  <input type="hidden" name="id" class="uid" value=<?= $user->id ?>>
  <input type="hidden" class="csrf" value=<?= $_SESSION['csrf'] ?>>
  <button type="button" class="back-button" onclick="toggleUserBoxPopup(<?= $user->id ?>)">
    <ion-icon name="arrow-back"></ion-icon> 
  </button>
  <?php {
    $departments = User::getAgentDepartments($db, $user->id);
    $allDepartments = getDepartments($db); ?>
    <ul class="user-departments">
      <?php foreach ($departments as $department) { ?>
        <li class="department"><?= $department ?></li>
      <?php } ?>
      </ul>
    <input name="n" type="number" class="user-promotion" value="<?= $user->level ?>" min="0" max="2" step="1">
      <select name="departments" class="department-select">
        <?php foreach ($allDepartments as $allDepartment) { ?>
          <option value="<?= $allDepartment ?>"><?= $allDepartment ?></option>
        <?php } ?>
      </select>
      <button type="button" class="toggle-button" >
        <ion-icon name="close-outline" class = "cross" >
        </ion-icon>
        <ion-icon name="add-outline"  class = "add">
        </ion-icon>
      </button>
    <?php } ?>
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
      <label> <?php echo $curr_user['email']; ?></label>
    </div>
    <div id="type">
      <?php if ($curr_user['permissionLevel'] == 1) : ?>
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
  <form class="form-box-edit-profile" id = "profile-edit">
    <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
    <input type="hidden" name="uid" value=<?= $_SESSION['uid'] ?>>
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
    <div id="old-password">
      <input type="password" id="old-password-text" name="old-password">
    </div>
    <div id="new-password">
      <input type="password" id="new-password-text" name="new-password">
    </div>
    <div id = "save">
      <button type="submit" class="submit-update" formaction="/../actions/updating_profile.php" formmethod="post">Save</button>
    </div>
  </form>
<?php
}
?>