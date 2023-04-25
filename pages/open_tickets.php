<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }

  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');

  $db = getDatabaseConnection();

  if (empty($tickets)) {
    $tickets = null;}
?>

<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <script src="open_tickets.js" defer></script>
  <link rel="stylesheet" href="open_ticketsstyle.css">
</head>
<body>
  <header class="header">
      <h1>All tickets</h1>
      <section id="logout" >
        <div class ="logout-box">
          <p>Logout</p>
        </div>
      </section>
  </header>
<main>
  <form method="get">
    <label for="ticket-filter">Mostrar:</label>
    <select name="ticket-filter" id="ticket-filter" onchange="this.form.submit()">
      <option value="all" <?php if ($_GET['ticket-filter'] == 'all') echo 'selected'; ?>>Todos</option>
      <option value="open" <?php if ($_GET['ticket-filter'] == 'open') echo 'selected'; ?>>Abertos</option>
      <option value="closed" <?php if ($_GET['ticket-filter'] == 'closed') echo 'selected'; ?>>Fechados</option>
    </select>
  </form>
  <?php
    $status = isset($_GET['ticket-filter']) ? $_GET['ticket-filter'] : 'open'; //// esta linha supostamente tem de sair?
    $_GET['ticket-filter'] = $_GET['ticket-filter'] ?? 'all';
    $tickets = getFilteredTickets($db, $_GET['ticket-filter']);

    foreach ($tickets as $ticket) {
        $ticketObj = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['status'], $ticket['dateCreated'], $ticket['uID'], $ticket['department']);
        drawTicketForm($ticketObj, false);
    }
  ?>
  </main>
</body>    