<?php

require_once(__DIR__ . '/../database/tickets.php');

class Ticket
{
    public int $id;
    public string $title;
    public string $text;
    public string $dateCreated;
    public ?string $status;
    public ?string $department;
    public ?int $faqitem;
    public int $uid;
    public int $priority;
    public ?int $aid;
    private ?int $prev;
    private ?int $next;

    public function __construct(int $id, string $title, string $text, string $dateCreated, ?string $status, ?string $department, ?int $faqitem, int $uid, int $priority, ?int $aid, ?int $prev, ?int $next = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->dateCreated = $dateCreated;
        $this->status = $status ?? 'open';
        $this->department = $department;
        $this->faqitem = $faqitem;
        $this->uid = $uid;
        $this->priority = $priority;
        $this->aid = $aid;
        $this->prev = $prev;
        $this->next = $next;
    }

    static function getTicket(PDO $db, int $id): ?Ticket
    {
        $ticket = getTicket($db, $id);

        if (!$ticket) return null;

        return new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['status'], $ticket['department'], $ticket['faqitem'], $ticket['uID'], $ticket['priority'], $ticket['aID'], $ticket['history'], $ticket['future']);
    }

    static function getFilteredTickets(PDO $db, string $status, int $agent, string $department) {
        $tickets = getFilteredTickets($db, $status, $agent, $department);

        return Ticket::createArray($tickets);
    }

    static function getTicketsByTags(PDO $db, array $tags): array {
        $tickets = getTicketsWithTags($db, $tags);

        return Ticket::createArray($tickets);
    }

    static function getTicketsFromAgent(PDO $db, int $aid): array {
        $tickets = getTicketsFromAgent($db, $aid);

        return Ticket::createArray($tickets);
    }

    static function openTicket(PDO $db, int $uid, string $title, string $text, ?string $department): Ticket {
        $id = addTicket($db, $uid, $title, $text, $department);
        
        return Ticket::getTicket($db, $id);
    }

    static function getTicketsFromUser(PDO $db, int $uid): array {
        $tickets = getTicketsByUser($db, $uid);

        return Ticket::createArray($tickets);
    }

    static function getTicketsFromDepartment(PDO $db, string $department): array {
        if ($department == "unassigned") return array();
        else return getTicketsFromDepartment($db, $department);
    }

    function updateTicket(PDO $db, int $uid, string $title, string $text, ?string $department, int $id): Ticket {
        $newTicket = updateTicket($db, $uid, $title, $text, $department, $id, $this->status, $this->priority, $this->faqitem, $this->aid);

        return Ticket::getTicket($db, $newTicket);
    }

    function updateDepartment(PDO $db, string $department): Ticket {
        $newTicket = $this->updateTicket($db, $this->uid, $this->title, $this->text, $department, $this->id);

        return $newTicket;
    }

    function hasNext(): ?int {
        return $this->next;
    }

    function hasPrev(): ?int {
        return $this->prev;
    }

    function getPrev(PDO $db): ?Ticket {
        if (isset($this->prev)) {
            $ticket = Ticket::getTicket($db, $this->prev);
            $ticket->next = $this->id;
            return Ticket::getTicket($db, $this->prev);
        }
        else return null;
    }

    function getNext(PDO $db): ?Ticket {
        if (isset($this->next)) {
            return Ticket::getTicket($db, $this->next);
        }
        else return null;
    }

    private static function createArray(array $tickets): array {
        $res = array();
        foreach ($tickets as $ticket) {
            $res[] = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['status'], $ticket['department'], $ticket['faqitem'], $ticket['uID'], $ticket['priority'], $ticket['aID'], $ticket['history'], $ticket['future']);
        }

        return $res;
    }

    static function joinFilters(array ...$filteredTickets): array {
        if (count(array_filter($filteredTickets)) == 1) return array_filter($filteredTickets); 
        return array_intersect(...array_filter($filteredTickets));
    }

    function deleteTicket(PDO $db): void {
        deleteTicket($db, $this->id);
    }

    function changeStatus(PDO $db, string $newStatus): void {
        if ($this->status == $newStatus) return;
        else changeStatus($db, $newStatus, $this->id);
        $this->status = $newStatus;
    } 

    function changePriority(PDO $db, int $newPriority): void {
        if ($this->priority == $newPriority) return;
        else changePriority($db, $newPriority, $this->id);
        $this->priority = $newPriority;
    }

    public function __toString() {
        return strval($this->id);
    }
}
