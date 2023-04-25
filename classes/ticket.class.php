<?php

require_once(__DIR__ . '/../database/tickets.php');

class Ticket
{
    public int $id;
    public string $title;
    public string $text;
    public string $dateCreated;
    public ?string $department;
    public int $uid;
    public ?int $aid;
    private ?int $prev;
    private ?int $next;

    public function __construct(int $id, string $title, string $text, string $dateCreated, ?string $department, int $uid, ?int $aid, ?int $prev, ?int $next = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->dateCreated = $dateCreated;
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

        return new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history'], $ticket['future']);
    }

    static function openTicket(PDO $db, int $uid, string $title, string $text, ?string $department): Ticket {
        $id = addTicket($db, $uid, $title, $text, $department);
        
        return Ticket::getTicket($db, $id);
    }

    static function getTicketsFromUser(PDO $db, int $uid): array {
        $tickets = getTicketsByUser($db, $uid);

        $res = array();
        foreach ($tickets as $ticket) {
            $res[] = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history'], $ticket['future']);
        }

        return $res;
    }

    function updateTicket(PDO $db, int $uid, string $title, string $text, ?string $department, int $id): Ticket {
        $newTicket = updateTicket($db, $uid, $title, $text, $department, $id);

        return Ticket::getTicket($db, $newTicket);
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
}
