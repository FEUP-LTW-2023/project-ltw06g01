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
  $faqs = FAQ::getAllFAQ($db);
?>

<!DOCTYPE html>
<html>
<head>
<title>FAQs</title>
  <script src="/../javascript/faq.js" defer></script>
  <script src="/../javascript/scr.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/faqStyle.css">
</head>
<body>
    <header>
      <?php drawHeader(0, 4,  "FAQs"); ?>
    </header>
  <div id = "content">
      <div id="faqs">
        <?php getFAQ($faqs); ?>
      </div>
  </div>
  <div id="footer">
      <p>Algum footer que queiramos</p>
  </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

