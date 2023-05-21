<?php

require_once(__DIR__ . '/../database/faq.php');

class FAQ 
{
    public string $question;
    public string $answer;
    public int $id;
    public string $dateCreated;
    public function __construct(int $id, string $question, string $answer, string $dateCreated) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->dateCreated = $dateCreated;
    }

    static function getAllFAQ(PDO $db): array {
        $items = getFAQItems($db);

        return FAQ::createArray($items);
    }

    static function getFAQItem(PDO $db, int $id): FAQ {
        $item = getSingleFAQ($db, $id);

        return new FAQ($item['id'], $item['question'], $item['answer'], $item['dateCreated']);
    }

    static function createFAQItem(PDO $db, string $question, string $answer): FAQ {
        $id = createFAQItem($db, $question, $answer);

        return FAQ::getFAQItem($db, $id);
    }

    public function assignToTicket(PDO $db, $tID): void {
        assignFAQItemToTicket($db, $this->id, $tID);
    }

    static private function createArray($items): array {
        $res = array();

        foreach ($items as $item) {
            $res[] = new FAQ($item['id'], $item['question'], $item['answer'], $item['dateCreated']);
        }

        return $res;
    }
}
