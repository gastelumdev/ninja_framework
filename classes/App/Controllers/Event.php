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

    public function create() {
        $request = $_POST;
        $user = 5;

        $event = [
            'name' => $request['name'],
            'description' => $request['description'],
            'date' => $request['date'] . ' ' . $request['time'],
            'created_by' => $user
        ];

        // 2022-01-09 OG NEW - This saves the data and returns with the new id 
        $thisEvent = $this->eventsTable->save($event);

        $response = json_encode($thisEvent);
        return $response;
    }
}