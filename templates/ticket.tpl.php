<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../classes/user.class.php');

function drawTicketForm(?Ticket $ticket, bool $edit, array $tags = array())
{
    $validity = isValidUser($ticket->uid ?? -1, $ticket->aid ?? -1, $_SESSION['uid'], $_SESSION['level']);
    
    /*adicionei este if para colocar o link para a edição do ticket, caso esteja dentro da página view_ticket então vai ter esse link*/
    if ($_SERVER['PHP_SELF'] == '/../pages/view_ticket.php' && isset($ticket)) {
        echo '<a id="edit" href="../pages/ticket.php?id=' . $ticket->id . '">Edit</a>';
    }

    if (isset($ticket)) {
        $buttonText = "Editado";
        $action = "../actions/edit_ticket.action.php";
    } else {
        $buttonText = "Enviar";
        $action = "../actions/open_ticket.action.php";
        $ticket = new Ticket(-1, "", "", "", "", 0, 0, 0, 0, 0);
    }

    $allTags = getAllTags(getDatabaseConnection());
?>
            <form id="ticket-form">


                <input type="hidden" name="csrf" value<?= $_SESSION['csrf'] ?>>
                <div id="title_box">
                    <?php if ($ticket->id == -1) { ?> <h2>Novo Ticket</h2> <?php } 
                    else if ($edit) { ?> <h2>Editar:</h2> <?php } ?> 
                </div>

                <div id="delete-button">
                <?php if ((strpos($_SERVER['REQUEST_URI'], 'open_tickets') !== false) || strpos($_SERVER['PHP_SELF'], 'view_ticket.php') !== false) { ?>
                    <button type="submit">
                        <ion-icon id="delete-not-hover" name="trash-outline"></ion-icon>
                        <ion-icon id="delete-hover" name="trash"></ion-icon>
                    </button>
                <?php } ?>
                </div>

                <div id="edit">
                    <?php
                        if (strpos($_SERVER['PHP_SELF'], 'view_ticket.php') !== false) { ?>
                        <a href="../pages/ticket.php?id=<?= $ticket->id ?>"> 
                            <ion-icon id="edit-not-hover" name="hammer-outline"></ion-icon> 
                            <ion-icon id="edit-hover" name="hammer"></ion-icon>
                        </a>
                    <?php } ?>
                </div>

                <input type="hidden" name="id" id="tid" value=<?= $ticket->id ?>>
                <div id="departamento">
                    <label for="department">Departamento:</label>
                    <select id="department" name="department" <?php if (!$edit && $validity != 2) echo 'disabled'; ?>>
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
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'open_tickets') !== false) { ?>
                        <ion-icon name="file-tray-full"></ion-icon>
                    <?php } ?>
                    <input type="text" id="subject" name="title" <?php if (!$edit) echo 'readonly'; ?> value="<?= $ticket->title ?>">
                </div>

                <div id="textArea">
                    <label for="fulltext">Mensagem:</label>
                    <textarea id="tickettext" name="fulltext" <?php if (!$edit) echo 'readonly'; ?>><?= $ticket->text ?></textarea>
                </div>

                <?php if ($_SESSION['level'] >= 1) {
                    ?> <div class="tagsArea"> <p> Tags: </p>

                        <div class="tags">
                        <?php 
                        foreach ($tags as $tag) {
                            ?>
                                    <div class="tag"><?=$tag['tag']?> <?php if ($edit) { ?> <span class="tag-delete">X</span> <?php } ?> </div>
                        <?php 
                        } ?>
                        </div>

                        <div>
                            <input name="tagdata" list="taglist" class="tag-input">
                            <input type="hidden" name="tag-string" class="curr-tags" value=<?=implode(',', array_map(fn($tag) => $tag['tag'], $tags))?>>
                            <datalist id="taglist">
                                <?php foreach ($allTags as $allTag) { ?>
                                    <option><?=$allTag['name']?></option>
                                <?php } ?>
                                </datalist> 
                                <button type="button" class="tag-add">+</button>
                        </div>

                </div> 
                <?php } ?>
                <?php if ($edit) { ?> <button id="enviar" type="submit" formaction=<?= $action ?> formmethod="post"><?= $buttonText ?></button> <?php } ?>
            </form>
<?php }

function drawNavigationButtons($prev, $next)
{
?> <nav id= "hist-ticket">
        <form>
            <input type="hidden" value=<?= $prev ?> name="prev">
            <input type="hidden" value=<?= $next ?> name="next">
            <button type="submit" name="prev-button" formaction="view_ticket.php" formmethod="get" id="prev-button" <?php if (!isset($prev)) echo "disabled"; ?>>&lt; </button>
            <button type="submit" name="next-button" formaction="view_ticket.php" formmethod="get" id="next-button" <?php if (!isset($next)) echo "disabled"; ?>>&gt;</button>
        </form>
    </nav>
<?php } 

function drawAssignAgent($db, $ticket) {
    $agents = User::getAgentsFromDepartment($db, $ticket->department);
    ?> <form class="assign-box">
        <input type="hidden" class="assign-id" value=<?= $ticket->id ?>>
        <select name="agents" class="agent-list"> <?php 
        foreach($agents as $agent) {
            ?> <option value=<?= $agent->id ?>><?= $agent->username ?></option> <?php
        } ?>
        </select>
        <button type="button" class="assign-confirm">Assign</button>
    </form> <?php     
}

?>