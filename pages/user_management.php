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
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <link rel="stylesheet" href="/../css/user_managementStyle.css">
    <link rel="stylesheet" href="/../css/geralStyle.css">
    <script src="/../javascript/all_variables.js" defer></script>
    <script src="/../javascript/login_logout_transitions.js" defer></script>
    <script src="/../javascript/department_toggle.js" defer></script>
    <script src="/../javascript/user_promotion.js" defer></script>
    <script src="/../javascript/rotating_transition.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </head>
  <body>
    <header>
        <?php drawHeader(0, 4, "Manage"); 
        drawMessages($session);?>
    </header>
      <?php drawNav(); ?>
    <main>
      <section id="manage_entities"> 
        <a href= "/../pages/manage_entities.php"><span>Wanna manage entities?</span></a>
      </section>
      <p id="all-users-title">All users:</p>
      <section id="all-users">
        <?php
          foreach ($users as $user) {
            drawUserBox($db, $user);
          }
          ?>
      </section>
    </main>
  </body>
</html>

