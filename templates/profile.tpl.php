<?php
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../database/departments.php');

function getUserType($level)
{
  $userTypes = [
    0 => 'Client',
    1 => 'Agent',
    2 => 'Admin'
  ];

  return isset($userTypes[$level]) ? $userTypes[$level] : 'Desconhecido';
}

function drawUserBox(PDO $db, User $user)
{ ?>
  <div class="backdrop"></div>
  <div class="user-box" id="userBox-<?= $user->id ?>" data-user-id="<?= $user->id ?>">
    <h3 class="name"><?= $user->username ?></h3>
    <p class="email"><?= $user->email ?></p>
  </div>
  <div class="user-box-popup" id="userBoxPopup-<?= $user->id ?>">
    <input type="hidden" name="id" class="uid" value=<?= $user->id ?>>
    <input type="hidden" class="csrf" value=<?= $_SESSION['csrf'] ?>>
    <button type="button" class="back-button">
      <ion-icon name="arrow-back"></ion-icon>
    </button>
    <?php {
      $departments = User::getAgentDepartments($db, $user->id);
      $allDepartments = getDepartments($db); ?>
      <h3 class="users-department">User's Departments</h3>
      <ul class="user-departments">
        <?php foreach ($departments as $department) { ?>
          <li class="department"><?= $department ?></li>
        <?php } ?>
      </ul>
      <select name="user-type" class="user-type-select">
        <option value="0" <?= ($user->level == 0) ? 'selected' : '' ?>>Client</option>
        <option value="1" <?= ($user->level == 1) ? 'selected' : '' ?>>Agent</option>
        <option value="2" <?= ($user->level == 2) ? 'selected' : '' ?>>Admin</option>
      </select>
      <select name="departments" class="department-select">
        <?php foreach ($allDepartments as $allDepartment) { ?>
          <option value="<?= $allDepartment ?>"><?= $allDepartment ?></option>
        <?php } ?>
      </select>
      <button type="button" class="toggle-button">
        Toggle
      </button>
    <?php } ?>
  </div>
<?php } ?>



<?php
function drawProfile($curr_user)
{
?>
  <div class="form-box-profile" id="profile_box">
    <div id="edit">
      <ion-icon name="hammer-outline"></ion-icon>
    </div>
    <div class="name">
      <label> <?php echo $curr_user['username']; ?> </label>
    </div>
    <div class="image">
      <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div class="email">
      <label> <?php echo $curr_user['email']; ?></label>
    </div>
    <div id="type">
      <?php if ($curr_user['permissionLevel'] == 1) : ?>
        <label>Type: Agent</label>
      <?php elseif ($curr_user['permissionLevel'] == 2) : ?>
        <label>Type: Admin</label>
      <?php else : ?>
        <label>Type: Client</label>
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
  <form class="form-box-edit-profile" id="profile-edit">
    <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
    <input type="hidden" name="uid" value=<?= $_SESSION['uid'] ?>>
    <div id="back">
      <ion-icon name="close-outline"></ion-icon>
    </div>
    <div class="image">
      <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div class="name">
      <input type="text" required id="username" name="username" value="<?php echo $curr_user['username']; ?>">
    </div>
    <div class="email">
      <input type="email" required id="email-text" name="email" value="<?php echo $curr_user['email']; ?>">
    </div>
    <div id="old-password">
      <input type="password" id="old-password-text" name="old-password" placeholder="Old Password">
    </div>
    <div id="new-password">
      <input type="password" id="new-password-text" name="new-password" placeholder="New Password">
    </div>
    <div id="save">
      <button type="submit" class="submit-update" formaction="/../actions/updating_profile.php" formmethod="post">Save</button>
    </div>
  </form>
<?php
}
?>