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

        $eventsArray = [];

        foreach ($events as $event) {

            // 2022-01-16 OG NEW - Split the date into date and time
            $dateElements = explode(' ', $event['date'], 2);
            $event['date'] = $dateElements[0];
            $event['time'] = $dateElements[1];


            $eventsArray[] = [
                'id' => $event['id'],
                'name' => $event['name'],
                'description' => $event['description'],
                'date' => $event['date'],
                'time' => $event['time']
            ];
        }

        return [
            'title' => 'Events',
            'template' => 'admin_events_list.html.php',
            'variables' => [
                'title' => 'Events',
                'events' => $eventsArray,
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
        $thisEventId = $this->eventsTable->save($event);

        $thisEvent = $this->eventsTable->findById($thisEventId);

        // 2022-01-16 OG NEW - Split the date into date and time
        $dateElements = explode(' ', $thisEvent['date'], 2);
        $thisEvent['date'] = $dateElements[0];
        $thisEvent['time'] = $dateElements[1];

        $response = json_encode($thisEvent);
        return $response;
    }

    public function delete() {
        $request = $_POST;

        $this->eventsTable->delete($request['id']);

        if (isset($_POST['id'])) {
            return json_encode(['msg' => 'Success']);
        } else {
            return json_encode(['msg' => 'Failed']);
        }
    }

    public function update() {
        $request = $_POST;

        $event = [
            'id' => $request['id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'date' => $request['date'] . ' ' . $request['time']
        ];

        $thisEventId = $this->eventsTable->save($event);

        $thisEvent = $this->eventsTable->findById($thisEventId);

        // 2022-01-16 OG NEW - Split the date into date and time
        $dateElements = explode(' ', $thisEvent['date'], 2);
        $thisEvent['date'] = $dateElements[0];
        $thisEvent['time'] = $dateElements[1];

        $response = json_encode($thisEvent);
        return $response;
    }
}