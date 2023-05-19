<?php 
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: page.php');
}

  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../database/tags.php');


  $db = getDatabaseConnection();

  if (isset($_GET['id'])) {
    $ticket = Ticket::getTicket($db, $_GET['id']);
    if ($ticket->hasNext()) header("Location: ../pages/view_ticket.php?id=$tiket->id");
    $tags = getTicketTags($db, $ticket->id);
  }
  else {
    $ticket = null;
    $tags = array();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Enviar Ticket</title>
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <script src="/../javascript/tag_script.js" defer ></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/ticketStyle.css">
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "Create Ticket"); 
    drawMessages($session);?>
  </header>
    <?php drawNav(); ?>
  <div id="content">
    <?php drawTicketForm($ticket, true, $tags, true); ?>
  </div>
  <div id="footer">
    <p>Algum footer que queiramos</p>
  </div>
</body>
</html>
