<?php

require_once(__DIR__ . '/../database/tickets.php');

class Ticket
{
    public int $id;
    public string $title;
    public string $text;
    public string $dateCreated;
    public string $status;
    public ?string $department;
    public int $uid;
    public ?int $aid;
    private ?int $prev;
    private ?int $next;

    public function __construct(int $id, string $title, string $text, string $dateCreated, string $status, ?string $department, int $uid, ?int $aid, ?int $prev, ?int $next = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->dateCreated = $dateCreated;
        $this->status = $status;
        $this->department = $department;
        $this->uid = $uid;
        $this->aid = $aid;
        $this->prev = $prev;
        $this->next = $next;
    }

    static function getTicket(PDO $db, int $id): ?Ticket
    {
        $ticket = getTicket($db, $id);

        if (!$ticket) return null;

        return new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['status'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history'], $ticket['future']);
    }

    static function getFilteredTickets(PDO $db, ?string $filter) {
        $tickets = getFilteredTickets($db, $filter);

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
        $newTicket = updateTicket($db, $uid, $title, $text, $department, $id);

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
            $res[] = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['status'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history'], $ticket['future']);
        }

        return $res;
    }

    static function joinFilters(array ...$filteredTickets): array {
        if (count(array_filter($filteredTickets)) == 1) return array_filter($filteredTickets); 
        echo var_dump(array_filter($filteredTickets));
        return array_intersect(...array_filter($filteredTickets));
    }

    function deleteTicket(PDO $db): void {
        deleteTicket($db, $this->id, $this->prev);
    }

    function changeStatus(PDO $db, string $newStatus): void {
        if ($this->status == $newStatus) return;
        else changeStatus($db, $newStatus, $this->id);
    } 

    public function __toString() {
        return strval($this->id);
    }
}
