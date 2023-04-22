<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
function drawTicketForm($ticket, $edit)
{
?>
    <div class="container">
        <section id="ticket-form">
            <h2>Preencha o Formulário do Ticket</h2>
            <form>
                <div>
                    <label for="department">Departamento:</label>
                    <select id="department" name="department" <?php if (!$edit) echo 'disabled';?>>
                        <?php if ($edit) {
                            foreach (getDepartments(getDatabaseConnection()) as $department) { ?>
                                <option value=<?= $department['name'] ?>><?= $department['name'] ?></option>
                            <?php }
                        } else { ?>
                            <option value=<?= $ticket['department'] ?>><?= $ticket['department'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="title">Assunto:</label>
                    <input type="text" id="subject" name="title" <?php if (!$edit) echo 'readonly';?> value=<?= $ticket['title'] ?>>
                </div>
                <div>
                    <label for="fulltext">Mensagem:</label>
                    <textarea id="message" name="fulltext" <?php if (!$edit) echo 'readonly';?>><?= $ticket['text'] ?></textarea>
                </div>
                <?php if ($edit) { ?> <button type="submit" formaction="../actions/open_ticket.action.php" formmethod="post">Enviar</button> <?php } ?>
            </form>
        </section>
    </div>
<?php } ?>