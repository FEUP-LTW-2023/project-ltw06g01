<?php

function drawTicketMessages($messages, $db)
{ ?>
  <section id="messages">
    <?php foreach ($messages as $message) { ?>
      <div class="message">
        <h2><?= getUser($db, $message['uID'])['username'] ?></h2>
        <h4><?= $message['dateSent'] ?></h4>
        <p><?= $message['text'] ?></p>
      </div>
    <?php } ?>
  </section>
<?php }

function drawAddMessage($ticket)
{ ?>
  <section>
    <form id="add-message">
      <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
      <input type="hidden" name="tID" value=<?= $ticket->id ?>>
      <input type="hidden" name="tuid" value=<?= $ticket->uid ?>>
      <input type="hidden" name="auid" value=<?= $ticket->aid ?? "\"\"" ?>>
      <input type="text" id="message-text" name="text" placeholder="Write a message">
      <button id="send-message" type="submit" formaction="../actions/send_message.action.php" formmethod="get">Send</button>
    </form>
  </section>
<?php }
