<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
function drawTicketForm(?Ticket $ticket, bool $edit)
{
    /*adicionei este if para colocar o link para a edição do ticket, caso esteja dentro da página view_ticket então vai ter esse link*/
    if ($_SERVER['PHP_SELF'] == '/../pages/view_ticket.php' && isset($ticket)) {
        echo '<a id="edit" href="../pages/ticket.php?id=' . $ticket->id . '">Edit</a>';
    }

    if (isset($ticket)) {
        $buttonText = "Editar";
        $action = "../actions/edit_ticket.action.php";
    } else {
        $buttonText = "Enviar";
        $action = "../actions/open_ticket.action.php";
        $ticket = new Ticket(-1, "", "", "", "", 0, 0, 0, 0, 0);
    }
?>
            <form id="ticket-form">
                <div id="title_box">
                    <?php if ($edit) { ?> <h2>Novo Ticket</h2> <?php } ?>
                </div>
                <!--
                <div id="edit">
                    <?php /*adicionei este if para colocar o link para a edição do ticket, caso esteja dentro da página view_ticket então vai ter esse link*/
                        if ($_SERVER['PHP_SELF'] == "/../pages/view_ticket.php?id={$ticket->id}" ||
                            $_SERVER['PHP_SELF'] == "/../pages/view_ticket.php?next=<?= $ticket->id ?>" || 
                            $_SERVER['PHP_SELF'] == "/../pages/view_ticket.php?prev=<?= $ticket->id ?>") { ?>
                        <a href="../pages/ticket.php?id=<?= $ticket->id ?>"> <p> Edit </p> </a>
                    <?php } ?>
                </div>
                -->
                <input type="hidden" name="id" id="tid" value=<?= $ticket->id ?>>
                <div id="departamento">
                    <label for="department">Departamento:</label>
                    <select id="department" name="department" <?php if (!$edit) echo 'disabled'; ?>>
                        <?php if ($edit) {
                            foreach (getDepartments(getDatabaseConnection()) as $department) { ?>
                                <option value=<?= $department ?>><?= $department ?></option>
                            <?php }
                        } else { ?>
                            <option value=<?= $ticket->department ?>><?= $ticket->department ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div id="assunto">
                    <label for="title">Assunto:</label>
                    <input type="text" id="subject" name="title" <?php if (!$edit) echo 'readonly'; ?> value="<?= $ticket->title ?>">
                </div>
                <div id="textArea">
                    <label for="fulltext">Mensagem:</label>
                    <textarea id="tickettext" name="fulltext" <?php if (!$edit) echo 'readonly'; ?>><?= $ticket->text ?></textarea>
                </div>
                <?php if ($edit) { ?> <button id="enviar" type="submit" formaction=<?= $action ?> formmethod="post"><?= $buttonText ?></button> <?php } ?>
            </form>
<?php }

function drawNavigationButtons($prev, $next)
{
?> <nav id= "hist-ticket">
        <form>
            <input type="hidden" value=<?= $prev ?> name="prev">
            <input type="hidden" value=<?= $next ?> name="next">
            <button type="submit" formaction="view_ticket.php" formmethod="get" id="prev-button" <?php if (!isset($prev)) echo "disabled"; ?>>&lt; </button>
            <button type="submit" formaction="view_ticket.php" formmethod="get" id="next-button" <?php if (!isset($next)) echo "disabled"; ?>>&gt;</button>
        </form>
    </nav>
<?php } ?>