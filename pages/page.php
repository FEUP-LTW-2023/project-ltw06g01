<?php
  require_once(__DIR__ . '/../classes/session.class.php');

  $session = new Session();
  
  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/status.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../database/tags.php');

  $db = getDatabaseConnection();

  $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

  if ($user_id !== null) {
    $tickets = Ticket::getTicketsFromUser($db, $user_id);

    if (empty($tickets)) {
        $tickets = null;
    }
  } else {
      $tickets = null;
  }

  if (empty($tickets)) {
    $tickets = null;}

  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }

  if ($session->isLoggedIn()){
    $loggedin = 1;
  }
  else{
    $loggedin = 0;
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Ticket System</title>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<script src="/../javascript/all_variables.js" defer></script>
<script src="/../javascript/page.js" defer></script>
<script src="/../javascript/login_logout_transitions.js" defer></script>
<script src="/../javascript/ticket_options.js" defer></script>
<script src="/../javascript/priority_change.js" defer></script>
  <link rel="stylesheet" href="/../css/pageStyle.css">
  
</head>
<body>

  <?php if (!$loggedin) { ?>
    <header id="not-logged-in">
      <?php drawHeader($animation, 3,  ""); 
      drawMessages($session);?>
    </header>
  <?php } else { ?>
    <header id="logged-in">
      <?php drawHeader($animation, 3,  "Home"); 
      drawMessages($session); ?>
    </header>
  <?php } ?>
  
          <?php drawNav(); ?>
  <div id="content-home">
          <?php drawEnterBoxes(); ?>

          <?php if($loggedin){ 
            if (!empty($tickets)) {?>
          <section id="allTickets" style="display: none;"> 
              <p>My tickets:</p>
                <?php foreach ((array)$tickets as $ticket) {
                        $tags = getTicketTags($db, $ticket->id); ?>
                        <div class="ticket-display">
                        
                          <?php drawTicketForm($ticket, false, $tags); ?>
                          <div class="options">
                            
                          <?php if ($_SESSION['level'] >= 1 ) { ?>
                                  <div class="filters-toggle">
                                      <ion-icon class="settings-not-hover" name="settings-outline"></ion-icon>
                                      <ion-icon class="settings-hover" name="settings"></ion-icon>
                                  </div>
                                  <div class="filters-container">
                                      <?php drawAssignAgent($db, $ticket);
                                            drawChangeStatus($db, $ticket); 
                                            drawPriorityButtons($ticket); ?>
                                  </div>
                            <?php } ?>

                              <a href="/../pages/view_ticket.php?id=<?php echo $ticket->id ?>">
                                <ion-icon class="view-not-hover" name="eye-outline"></ion-icon>
                                <ion-icon class="view-hover" name="eye"></ion-icon>
                              </a>

                              <div class="delete-button">
                                  <button class="delete-button-submit" type="submit" onclick="window.location.href = '../actions/delete_ticket.action.php';">
                                      <ion-icon class="delete-not-hover" name="trash-outline"></ion-icon>
                                      <ion-icon class="delete-hover" name="trash"></ion-icon>
                                  </button>
                              </div>
                           </div>
                        </div>
                <?php }
              } else { ?>
                  <p id="no_tickets"> Ainda não tem tickets. </p>
            <?php }
          } ?>
           </section>
    </div>
    <section class="FAQs">
      <ion-icon name="help-circle-outline" id="faqs-icon"></ion-icon>
      <h6>FAQ's</h6>
    </section>
  <footer>
      <p>Algum footer que queiramos</p>
  </footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

