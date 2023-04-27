<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }

  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');


  $db = getDatabaseConnection();

  if (isset($_GET['id'])) {
    $ticket = Ticket::getTicket($db, $_GET['id']);
  }
  else {
    $ticket = null;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Enviar Ticket</title>
  <script src="/../javascript/open_tickets.js" defer></script>
  <script src="/../javascript/scr.js" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="geralstyle.css">
</head>
<body>
  <div id="header">
    <?php drawHeader(0, 4, "All Tickets"); ?>
  </div>
  <div id="nav">
    <?php drawSideBar(); ?>
  </div>
  <div id="content">
    <?php drawTicketForm($ticket, true); ?>
  </div>
  <div id="footer">
    <p>Algum footer que queiramos</p>
  </div>
</body>
</html>
