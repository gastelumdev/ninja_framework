<?php
namespace App\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Event {
    private $eventsTable;
    private $authentication;

    public function __construct(DatabaseTable $eventsTable, Authentication $authentication) {
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;
    }

    public function list() {
        $events = $this->eventsTable->findAll();
        $count = $this->eventsTable->total();

        return [
            'title' => 'Events',
            'template' => 'admin_events_list.html.php',
            'variables' => [
                'title' => 'Events',
                'events' => $events,
                'count' => $count
            ]
        ];
    }
}