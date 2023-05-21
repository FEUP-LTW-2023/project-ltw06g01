<?php
  require_once(__DIR__ . '/../classes/session.class.php');
  require_once(__DIR__ . '/../classes/faq.class.php');
  require_once(__DIR__ . '/../database/faq.php'); 
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  include(__DIR__ . '/../templates/faq.tpl.php'); 

  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }

  if (isset($_SESSION['loggedin'])){
    $loggedin = $_SESSION['loggedin'];
  }
  else{
    $loggedin = 0;
  }
  $db = getDatabaseConnection();
  $user_type = $_SESSION['level'] ?? -1;
  $faqs = FAQ::getAllFAQ($db);
?>

<!DOCTYPE html>
<html>
<head>
<title>FAQs</title>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/faq.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/faqStyle.css">
  
</head>
<body>
    
    <?php if (!$loggedin) { ?>
    <header id="not-logged-in">
      <?php drawHeader($animation, 3,  "FAQs"); 
      drawMessages($session);?>
    </header>
  <?php } else { ?>
    <header id="logged-in">
      <?php drawHeader($animation, 3,  "FAQs"); 
      drawMessages($session); ?>
    </header>
  <?php } ?>
    
  <main>
      <div id= "faqs_more_button">

        <?php if ($user_type >= 1){?>
          <button id="add-faq-btn"><ion-icon name="add-outline"></ion-icon></button>
        <?php } ?>

        <div id="faqs">
          <?php getFAQ($faqs); ?>
        </div>

      </div>

      <?php if ($user_type >= 1){drawFAQForm();}?>

  </main>
  <footer>
      <p>Algum footer que queiramos</p>
  </footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

