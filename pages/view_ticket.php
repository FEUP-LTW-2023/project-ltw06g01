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

$ticket = Ticket::getTicket($db, $_GET['id']);
if (!(isValidUser($ticket->uid, $ticket->aid, $_SESSION['uid'], $_SESSION['level']))) header('Location: ../pages/page.php');
$messages = getMessagesFromTicket($db, $_GET['id']);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Visualizar Ticket</title>
  <link rel="stylesheet" href="styles2.css">
</head>

<body>
  <header>
    <h1>Visualizar Ticket</h1>
  </header>
  <main>
    <?php drawTicketForm($ticket, false); ?>
    <section id="messages">
      <?php foreach ($messages as $message) { ?>
        <div class="message">
          <h2><?= getUser($db, $message['uID'])['username'] ?></h2>
          <h4><?= $message['dateSent'] ?></h4>
          <p><?= $message['text'] ?></p>
        </div>
      <?php } ?>
    </section>
    <section id="add-message">
      <form>
        <input type="hidden" name="tID" value=<?= $ticket->id ?>>
        <input type="hidden" name="tuid" value=<?= $ticket->uid ?>>
        <input type="hidden" name="auid" value=<?= $ticket->aid ?>>
        <input type="text" id="message-text" name="text" placeholder="Write a message">
        <button type="submit" formaction="../actions/send_message.action.php" formmethod="get">Send</button>
      </form>
    </section>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>

</html>