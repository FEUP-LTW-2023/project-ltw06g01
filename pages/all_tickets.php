<?php
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
  header('Location: page.php');
}
require_once(__DIR__ . '/../classes/ticket.class.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/status.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/tags.php');

$db = getDatabaseConnection();

$_GET['ticket-filter-status'] = $_GET['ticket-filter-status'] ?? 'all';
$_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? 'default';
$_GET['ticket-filter-department'] = $_GET['ticket-filter-department'] ?? 'unassigned';
$_GET['ticket-filter-tag'] = $_GET['ticket-filter-tag'] ?? "";

if ($_GET['ticket-filter-agent'] == 'default') $_GET['ticket-filter-agent'] = -1;
$_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? -1;

$users = User::getUsersAdmin($db);
$departments = getDepartments($db);
$statuses = getAllStatuses($db);

if (!hasAccessToPage(1, $_SESSION['level'])) {
  $session->addMessage('error', 'Insufficient permissions');
  header('Location: /../pages/page.php');
}

if (empty($tickets)) {
  $tickets = null;
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>All Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <script src="/../javascript/ticket_options.js" defer></script>
  <script src="/../javascript/filters.js" defer></script>
  <script src="/../javascript/all_tickets.js" defer></script>
  <script src="/../javascript/agent_assign.js" defer></script>
  <script src="/../javascript/status_change.js" defer></script>
  <script src="/../javascript/tag_filter.js" defer></script>
  <script src="/../javascript/priority_change.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/all_ticketsStyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <header>
    <?php drawHeader(0, 4, "All Tickets");
    drawMessages($session); ?>
  </header>
  <?php drawNav(); ?>
  <main>
    <?php drawFilters($_GET, $departments, $users, array_map(fn ($value) => $value['name'], $statuses));
    $tickets = Ticket::getFilteredTickets($db, $_GET['ticket-filter-status'], $_GET['ticket-filter-agent'], $_GET['ticket-filter-department']);
    $tagTickets = Ticket::getTicketsByTags($db, $_GET['ticket-filter-tag'] == "" ? array() : explode(",", $_GET['ticket-filter-tag']));
    $tickets = array_intersect($tickets, $tagTickets); ?>

    <section id="allTickets">
      <?php foreach ($tickets as $ticket) {
        $tags = getTicketTags($db, $ticket->id); ?>
        <div class="ticket-display">

          <?php drawTicketForm($ticket, false, $tags);
          drawOpcions($db, $ticket); ?>
        </div>
      <?php } ?>
    </section>

  </main>
  <footer>
    <?php drawFooter(); ?>
  </footer>
</body>

</html>