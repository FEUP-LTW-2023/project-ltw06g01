<?php
session_start();
if (!isset($_SESSION['uid'])) {
  header('Location: page.php');
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/client.php');
require_once(__DIR__ . '/../database/message.php');
require_once(__DIR__ . '/../classes/ticket.class.php');
require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/tags.php');


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
  <link rel="stylesheet" href="/../css/view_ticketStyle.css">
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <script src="/../javascript/scr.js" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "Ticket history"); ?>
  </header>
  <div id="nav">
    <?php drawSideBar(); ?>
  </div>
  <div id="content">
    <?php if ($_SESSION['level'] >= 1) drawNavigationButtons($ticket->hasPrev(), $ticket->hasNext()); ?>
    <?php drawTicketForm($ticket, false, $tags); ?>
    <section id="messages">
      <?php foreach ($messages as $message) { ?>
        <div class="message">
          <h2><?= getUser($db, $message['uID'])['username'] ?></h2>
          <h4><?= $message['dateSent'] ?></h4>
          <p><?= $message['text'] ?></p>
        </div>
      <?php } ?>
    </section>
    <?php if (null === $ticket->hasNext()) { ?>
      <section>
        <form id="add-message">
          <input type="hidden" name="tID" value=<?= $ticket->id ?>>
          <input type="hidden" name="tuid" value=<?= $ticket->uid ?>>
          <input type="hidden" name="auid" value=<?= $ticket->aid ?>>
          <input type="text" id="message-text" name="text" placeholder="Write a message">
          <button id="send-message" type="submit" formaction="../actions/send_message.action.php" formmethod="get">Send</button>
        </form>
      </section>
    <?php } ?>
  </div>
  <div id="footer">
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
  </div>
</body>

</html>