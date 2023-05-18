<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../classes/faq.class.php');

function drawTicketForm(?Ticket $ticket, bool $edit, array $tags = array(), bool $single = false)
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
        $ticket = new Ticket(-1, "", "", "", "", 0, 0, 0, 0, 0, 0);
    }

    $allTags = getAllTags(getDatabaseConnection());
?>
            <form class="ticket-form">


                <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
                    <?php if ($ticket->id == -1) { ?> <h2 class="title_box">Novo Ticket</h2> <?php } 
                    else if ($edit) { ?> <h2 class="title_box">Editar:</h2> <?php } ?> 
                
                     <?php
                        if (($ticket->hasNext() == null) && strpos($_SERVER['PHP_SELF'], 'view_ticket.php') !== false) { ?>
                        <a href="../pages/ticket.php?id=<?= $ticket->id ?>" class="edit"> 
                            <ion-icon class="edit-not-hover" name="hammer-outline"></ion-icon> 
                            <ion-icon class="edit-hover" name="hammer"></ion-icon>
                        </a>
                    <?php } ?>

                <input type="hidden" name="id" class="tid" value=<?= $ticket->id ?>>
                <div class="departamento">
                    <?php if ($single) { ?><label for="department">Departamento:</label> <?php } ?>
                    <select class="department" name="department" <?php if (!$edit && $validity != 2) echo 'disabled'; if ($single) echo "id=\"department\"";?>>
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

                <div class="assunto">
                    <?php if ($single) { ?><label for="title">Assunto:</label> <?php } ?>
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'open_page') !== false || strpos($_SERVER['REQUEST_URI'], 'page.php') !== false) { ?>
                        <ion-icon name="file-tray-full"></ion-icon>
                    <?php } ?>
                    <input type="text" class="subject" name="title" <?php if (!$edit || ($validity != 3 && $validity != 1 && $ticket->id != -1)) echo 'readonly'; if ($single) echo "id=\"title\"";?> value="<?= $ticket->title ?>">
                </div>

                <div class="textArea">
                    <?php if ($single) { ?><label for="fulltext">Mensagem:</label><?php } ?>
                    <textarea class="tickettext" name="fulltext" <?php if (!$edit || ($validity != 3 && $validity != 1 && $ticket->id != -1)) echo 'readonly'; if ($single) echo "id=\"fulltext\"";?>><?= $ticket->text ?></textarea>
                </div>

                <?php if ($_SESSION['level'] >= 1 ) {
                    ?> <div class="tagsArea"> <?php if( $tags != null || strpos($_SERVER['REQUEST_URI'], 'ticket.php') !== false ) { ?> <h4> Tags: </h4> <?php } ?>

                        <ul class="tags">
                        <?php 
                        foreach ($tags as $tag) {
                            ?>
                                    <li class="tag"><?=$tag['tag']?> <?php if ($edit) { ?> <span class="tag-delete">X</span> <?php } ?> </li>
                        <?php 
                        } ?>
                        </ul>


                            <input name="tagdata" list="taglist" class="tag-input">
                            <input type="hidden" name="tag-string" class="curr-tags" value=<?=implode(',', array_map(fn($tag) => $tag['tag'], $tags))?>>
                            <datalist id="taglist">
                                <?php foreach ($allTags as $allTag) { ?>
                                    <option><?=$allTag['name']?></option>
                                <?php } ?>
                                </datalist> 
                                <button type="button" class="tag-add">+</button>

                </div> 
                <?php } ?>
                <?php if ($edit) { ?> <button class="enviar" type="submit" formaction=<?= $action ?> formmethod="post"><?= $buttonText ?></button> <?php } ?>
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

/*
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
*/

function drawAssignAgent($db, $ticket) {
    $agents = User::getAgentsFromDepartment($db, $ticket->department);
    ?> <form class="assign-box">
        <input type="hidden" class="assign-id" value=<?= $ticket->id ?>>
        <input type="hideen" class="csrf" value=<?= $_SESSION['csrf'] ?>>
        <select name="agents" class="agent-list" onchange="this.form.submit()"> <?php 
        foreach($agents as $agent) {
            ?> <option value=<?= $agent->id ?> <?php if ($ticket->aid == $agent->id) echo 'selected'; ?>><?= $agent->username ?></option> <?php
        } ?>
        </select>
        <button type="button" class="assign-confirm">Assign</button>
    </form> <?php     
}

/*
function drawChangeStatus($db, $ticket) { 
    $statuses = getAllStatuses($db);
    $statuses = array_map(fn($value) => $value['name'], $statuses); ?>
    <form class="status-box">
        <input type="hidden" class="status-id" value=<?= $ticket->id ?>>
        <select name="statuses" class="status-list"> <?php
        foreach ($statuses as $status) {
            ?> <option value=<?= $status ?> <?php if ($ticket->status == $status) echo 'selected'; ?>><?= $status ?></option> <?php
        } ?>
        </select>
        <button type="button" class="status-confirm">Change</button>
    </form> <?php
}
*/
function drawChangeStatus($db, $ticket) { 
    $statuses = getAllStatuses($db);
    $statuses = array_map(fn($value) => $value['name'], $statuses); ?>
    <form class="status-box">
        <input type="hidden" class="status-id" value=<?= $ticket->id ?>>
        <input type="hidden" class="csrf" value=<?= $_SESSION['csrf'] ?>>
        <select name="statuses" class="status-list" onchange="this.form.submit()"> <?php
        foreach ($statuses as $status) {
            ?> <option value=<?= $status ?> <?php if ($ticket->status == $status) echo 'selected'; ?>><?= $status ?></option> <?php
        } ?>
        </select>
        <button type="button" class="status-confirm">Change</button>
    </form> <?php
}

function drawTicketFAQ($db, $ticket, $edit) {
    if (!isset($ticket->faqitem) && $_SESSION['uid'] == $ticket->aid && $edit) { 
        $faqs = FAQ::getAllFAQ($db); ?>
        <form class="faq-box">
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" name="tid" value=<?= $ticket->id ?>>
            <select name="faq-selection" class="faq-list">
            <?php foreach ($faqs as $faq) { ?>
                <option value=<?= $faq->id ?>><?= $faq->question ?></option>
            <?php } ?>
            </select>
            <button type="submit" formaction="../actions/assign_faq.action.php" formmethod="post">Assign</button>
        </form> <?php 
    }
    else if (isset($ticket->faqitem)) { 
        $faq = FAQ::getFAQItem($db, $ticket->faqitem);  ?>
        <div id="faqitem">
            <h3><?= $faq->question?></h3>
            <p><?= $faq->answer ?></p>
        </div> <?php 
    }
}

function drawPriorityButtons($ticket) { ?>
    <form class="priority-box">
        <input type="hidden" name="csrf" class="csrf" value=<?= $_SESSION['csrf'] ?>>
        <input type="hidden" name="tid" class="tid" value=<?= $ticket->id ?>>
        <input type="hidden" name="priority" class="priority" value=<?= $ticket->priority ?>>
        <button type="button" class="increment-priority">
            <ion-icon name="arrow-up-outline"></ion-icon>
        </button>
        <button type="button" class="decrement-priority">
            <ion-icon name="arrow-down-outline"></ion-icon>
        </button>
    </form>
<?php }

function drawOpcions($db, $ticket){ ?>
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

        
        <?php if( !strpos($_SERVER['REQUEST_URI'], 'view_ticket.php') !== false) { ?>
            <a href="/../pages/view_ticket.php?id=<?php echo $ticket->id ?>">
                <ion-icon class="view-not-hover" name="eye-outline"></ion-icon>
                <ion-icon class="view-hover" name="eye"></ion-icon>
            </a>
        <?php }?>

        <div class="delete-button">
        <form>
            <input type="hidden" name="csrf" value=<?= $_SESSION['csrf'] ?>>
            <input type="hidden" name="id" value=<?= $ticket->id ?>>
            <button class="delete-button-submit" type="submit" formmethod="post" formaction="../actions/delete_ticket.action.php">
                <ion-icon class="delete-not-hover" name="trash-outline"></ion-icon>
                <ion-icon class="delete-hover" name="trash"></ion-icon>
            </button>
        </form>  
        </div>
    </div>
<?php
}
?>

