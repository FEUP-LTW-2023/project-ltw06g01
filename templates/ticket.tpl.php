<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
function drawTicketForm(?Ticket $ticket, bool $edit)
{
    if (isset($ticket)) {
        $buttonText = "Editar";
        $action = "../actions/edit_ticket.action.php";
    } else {
        $buttonText = "Enviar";
        $action = "../actions/open_ticket.action.php";
    }
?>
    <div class="container">
        <section id="ticket-form">
            <?php if ($edit) { ?> <h2>Preencha o Formulário do Ticket</h2> <?php } ?>
            <form>
                <input type="hidden" name="id" id="tid" value=<?= $ticket->id ?>>
                <div>
                    <label for="department">Departamento:</label>
                    <select id="department" name="department" <?php if (!$edit) echo 'disabled'; ?>>
                        <?php if ($edit) {
                            foreach (getDepartments(getDatabaseConnection()) as $department) { ?>
                                <option value=<?= $department['name'] ?>><?= $department['name'] ?></option>
                            <?php }
                        } else { ?>
                            <option value=<?= $ticket->department ?>><?= $ticket->department ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="title">Assunto:</label>
                    <input type="text" id="subject" name="title" <?php if (!$edit) echo 'readonly'; ?> value="<?= $ticket->title ?>">
                </div>
                <div>
                    <label for="fulltext">Mensagem:</label>
                    <textarea id="tickettext" name="fulltext" <?php if (!$edit) echo 'readonly'; ?>><?= $ticket->text ?></textarea>
                </div>
                <?php if ($edit) { ?> <button type="submit" formaction=<?= $action ?> formmethod="post"><?= $buttonText ?></button> <?php } ?>
            </form>
        </section>
    </div>
<?php }

function drawNavigationButtons()
{
?> <nav>
        <button type="button" id="prev-button">&lt;</button>
        <button type="button" id="next-button">&gt;</button>
    </nav>
<?php } ?>