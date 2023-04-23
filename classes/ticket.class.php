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
        $this->uid = $uid;
        $this->aid = $aid;
        $this->prev = $prev;
        $this->next = $next;
    }

    static function getTicket(PDO $db, int $id): ?Ticket
    {
        $ticket = getTicket($db, $id);

        if (!$ticket) return null;

        return new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history']);
    }

    static function getTicketsFromUser(PDO $db, int $uid): array {
        $tickets = getTicketsByUser($db, $uid);

        $res = array();
        foreach ($tickets as $ticket) {
            $res[] = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['dateCreated'], $ticket['department'], $ticket['uID'], $ticket['aID'], $ticket['history']);
        }

        return $res;
    }

    function updateTicket(PDO $db, int $uid, string $title, string $text, ?string $department, int $id): Ticket {
        $newTicket = updateTicket($db, $uid, $title, $text, $department, $id);

        return Ticket::getTicket($db, $newTicket);
    }
}
