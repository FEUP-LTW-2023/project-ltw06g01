<!DOCTYPE html>
<html>
<head>
<title>Ticket System - Create Ticket</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
  <h1>Ticket System</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
    </ul>
  </nav>
</header>
<main>
    <form>
        <input type="hidden" value=<?= $_GET['uid'] ?>>
        <input type="text" name="title" placeholder="Enter ticket title">
        <textarea name="fulltext" rows="8" cols="80">Please describe your issue here</textarea>
        <button formaction="open_ticket.php" formmethod="post" type="submit">Submit ticket</button>
    </form>
</main>
</body>    