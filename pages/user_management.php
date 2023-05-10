<?php
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../templates/profile.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    header('Location: page.php');
}

$db = getDatabaseConnection();
$users = User::getUsersAdmin($db);


?>
<!DOCTYPE html>
<html>
  <head>
  <title>All Tickets</title>
    <link rel="stylesheet" href="/../css/geralStyle.css">
    <link rel="stylesheet" href="/../css/user_managementStyle.css">
    <script src="/../javascript/scr.js" defer></script>
    <script src="/../javascript/department_toggle.js" defer></script>
    <script src="/../javascript/user_management.js" defer></script>
    <script src="/../javascript/user_promotion.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </head>
  <body>
    <header>
        <?php drawHeader(0, 4, "Manage users"); ?>
    </header>
    <div id="nav">
      <?php drawSideBar(); ?>
    </div>
    <div id="content">
      <div id="all-users">
        <?php
          foreach ($users as $user) {
            drawUserBox($db, $user, true);
          }
          ?>
      </div>
    </div>
  </body>
</html>

