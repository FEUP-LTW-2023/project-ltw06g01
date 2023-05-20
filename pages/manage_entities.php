<?php
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../database/status.php');
require_once(__DIR__ . '/../templates/admin.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    header('Location: page.php');
}

$db = getDatabaseConnection(); 
$departments = getDepartments($db); 
$statuses = array_map(fn($value) => $value['name'],getAllStatuses($db)); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Ticket System</title>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<script src="/../javascript/all_variables.js" defer></script>
<link rel="stylesheet" href="../css/manage_entities.css">
<link rel="stylesheet" href="../css/geralStyle.css">
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "Profile"); 
    drawMessages($session);?>
  </header>
    <?php drawNav(); ?>
  <main>
    <p> Create or Delete Departments: </p>
    <ul id="department-delete">
        <?php foreach ($departments as $department) {
            drawRemoveDepartment($department);
        } ?>
    </ul>
    <?php drawAddDepartment(); ?>

    <p> Create or Delete status: </p>
    <ul id="status-delete">
        <?php foreach ($statuses as $status) {
            drawRemoveStatus($status);
        } ?>
    </ul>
    <?php drawAddStatus(); ?>
  </main>
    <footer>
      <p>Algum footer que queiramos</p>
    </footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
</body>
</html>
    