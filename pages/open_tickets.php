<?php 
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: page.php');
}
  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../database/tags.php');

  $db = getDatabaseConnection();
  
  $_GET['ticket-filter-status'] = $_GET['ticket-filter-status'] ?? 'all';

  if ($_GET['ticket-filter-agent'] == 'default') $_GET['ticket-filter-agent'] = -1;
  $_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? -1;

  $users = User::getUsersAdmin($db);

  if (empty($tickets)) {
    $tickets = null;}
?>

<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <script src="/../javascript/scr.js" defer></script>
  <script src="/../javascript/open_tickets.js" defer></script>
  <script src="/../javascript/agent_assign.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/open_ticketsStyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "All Tickets"); ?>
  </header>
  <div id="nav">
    <?php drawSideBar(); ?>
  </div>
  <div id="content">
    <form id="filtro" method="get" class="ticket-filter-container">
      <label for="ticket-filter-status">Mostrar:</label>
      <select name="ticket-filter-status" id="ticket-filter" onchange="this.form.submit()">
        <option value="all" <?php if ($_GET['ticket-filter-status'] == 'all') echo 'selected'; ?>>Todos</option>
        <option value="open" <?php if ($_GET['ticket-filter-status'] == 'open') echo 'selected'; ?>>Abertos</option>
        <option value="closed" <?php if ($_GET['ticket-filter-status'] == 'closed') echo 'selected'; ?>>Fechados</option>
      </select>
      <select name="ticket-filter-agent" class="ticket-filter" onchange="this.form.submit()">
         <option value="default" selected></option>
      <?php foreach ($users as $user) {
        if ($user->level < 1 ) continue; ?>
         <option value=<?= $user->id ?>><?= $user->username ?></option>
      <?php } ?>
  </select>
    </form>
    <?php
      $status = isset($_GET['ticket-filter-status']) ? $_GET['ticket-filter-status'] : 'open'; //// esta linha supostamente tem de sair?
      $tickets = Ticket::getFilteredTickets($db, $_GET['ticket-filter-status']);
      $ticketsAgent = Ticket::getTicketsFromAgent($db, $_GET['ticket-filter-agent']);
      $finalTickets = Ticket::joinFilters($tickets, $ticketsAgent);?>

      <div id="allTickets">
        <?php foreach ($finalTickets as $ticket) { 
                $tags = getTicketTags($db, $ticket->id); ?>
                <div>
                  <?php drawAssignAgent($db, $ticket); ?>
                  <a href="/../pages/view_ticket.php?id=<?php echo $ticket->id ?>">
                     <?php drawTicketForm($ticket, false, $tags); ?>
                  </a>
                </div>
        <?php } ?>
      </div>

  </div>
  <div id="footer">
    <footer>
      <p>Algum footer que queiramos</p>
    </footer>
  </div>
</body>
</html>
