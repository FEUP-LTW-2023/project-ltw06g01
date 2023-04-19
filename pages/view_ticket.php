<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/message.php');
    require_once(__DIR__ . '/../utils/validations.php');

    $db = getDatabaseConnection();
    $ticket = getTicket($db, $_GET['id']);
    if (!(isValidUser($ticket['uID'], $ticket['aID'], $_SESSION['uid'], $_SESSION['level']))) header('Location: ../pages/page.php');
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
    <div class="container">
      <section id="ticket-form">
        <h2>Preencha o Formulário do Ticket</h2>
        <form action="../actions/open_ticket.action.php" method="post">
          <div>
            <label for="department">Departamento:</label>
            <select id="department" name="department" disabled>
                <option value=<?=$ticket['department']?>><?=$ticket['department']?></option>
            </select>
          </div>
          <div>
            <label for="title">Assunto:</label>
            <input type="text" id="subject" name="title" readonly value=<?=$ticket['title']?>>
          </div>
          <div>
            <label for="fulltext">Mensagem:</label>
            <textarea id="message" name="fulltext" readonly><?=$ticket['text']?></textarea>
          </div>
        </form>
      </section>
    </div>
    <section id="messages">
        <?php foreach ($messages as $message) { ?>
        <div class = "message">
            <h2><?=$message['dateSent']?></h2>
            <p><?=$message['text']?></p>
        </div>
        <?php } ?>
    </section>    
    <section id="add-message"> 
        <form>
            <input type="hidden" name="tID" value=<?=$ticket['id']?>>
            <input type="hidden" name="tuid" value=<?=$ticket['uID']?>>
            <input type="hidden" name="auid" value=<?=$ticket['aUID']?>>
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
