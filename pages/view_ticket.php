<?php
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
  header('Location: page.php');
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/client.php');
require_once(__DIR__ . '/../database/message.php');
require_once(__DIR__ . '/../classes/ticket.class.php');
require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');
require_once(__DIR__ . '/../templates/messages.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/tags.php');
require_once(__DIR__ . '/../database/status.php');


$db = getDatabaseConnection();

if (!isset($_GET['id'])) {
  if (isset($_GET['prev-button'])) $_GET['id'] = $_GET['prev'];
  else if (isset($_GET['next-button'])) $_GET['id'] = $_GET['next'];
}

$ticket = Ticket::getTicket($db, $_GET['id']);
$tags = getTicketTags($db, $ticket->id);
$validity = isValidUser($ticket->uid, $ticket->aid, $_SESSION['uid'], $_SESSION['level']);
if ($validity == 0) header('Location: ../pages/page.php');
$messages = getMessagesFromTicket($db, $_GET['id']);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Visualizar Ticket</title>
  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/view_ticketStyle.css">
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/ticket_options.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <script src="/../javascript/agent_assign.js" defer></script>
  <script src="/../javascript/status_change.js" defer></script>
  <script src="/../javascript/priority_change.js" defer></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <header>
    <?php drawHeader(0, 4, "Ticket history");
    drawMessages($session); ?>
  </header>
  <?php drawNav(); ?>
  <main>
    <?php if ($_SESSION['level'] >= 1) drawNavigationButtons($ticket->hasPrev(), $ticket->hasNext()); ?>

    <div class="ticket-display">
      <?php
      drawTicketForm($ticket, false, $tags, true);
      drawTicketFAQ($db, $ticket, true);
      drawOpcions($db, $ticket);
      ?>
    </div>
    <?php drawTicketMessages($messages, $db);
    if (null === $ticket->hasNext()) drawAddMessage($ticket); ?>
  </main>
  <footer>
    <?php drawFooter(); ?>
  </footer>
</body>

</html>