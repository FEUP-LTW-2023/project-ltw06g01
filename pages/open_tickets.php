<!DOCTYPE html>
<html>
<head>
<title>Open Tickets</title>
  <link rel="stylesheet" href="open_ticketsstyle.css">
</head>
<body>
  <header class="header">
      <h1>Open tickets</h1>
      <section id="logout" >
        <div class ="logout-box">
          <p>Logout</p>
        </div>
      </section>
  </header>
<main>
    <form>
        <input type="hidden" name="uid" value=<?= $_GET['uid'] ?>>
        <input type="text" name="title" placeholder="Enter ticket title">
        <textarea name="fulltext" rows="8" cols="80">Please describe your issue here</textarea>
        <button formaction="open_ticket.php" formmethod="post" type="submit">Submit ticket</button>
    </form>
</main>
</body>    