<?php
use Instagram\SDK\Instagram;
use Validator\Rules\DoubleArrayRule;

require_once 'vendor/autoload.php';

// Initialize the Instagram library
$instagram = new Instagram();

// Authenticate using username and password
if (!is_file('pouriyak7')) {
    $envelope = $instagram->login('pouriyak7', 'h6364501');
    $session = $envelope->getSession();
    file_put_contents($session->getUser()->getUsername(), serialize($session));
}
else {
    $session = unserialize(file_get_contents('pouriyak7'));
    $instagram->setSession($session);
}


$users = $instagram->searchByUser('braveputak');
if (!$users->isSuccess()) {
    die($users);
}
foreach ($users->getUsers() as $user){
    if('braveputak' == $user->getUsername()){
        $userID = $user->getId();
        $feed = $user->feed();
    }
}


if($feed->isSuccess()){
    $items = $feed->getItems();
    dd($feed);
    foreach ($items as $item) {
        dd($item);
    }
}
try {

    $feed = $instagram->feedByHashtag('hello');
    var_dump($feed);
}catch (Exception $e){
    dd($e->getMessage());
}

//
if (!isset($userID))
    die('fuck mark zackerburg');

// Retrieve the inbox envelope

//$instagram->sendThreadMessage('', '');
//
//$envelope = $instagram->inbox();

// Retrieve the inbox
//$inbox = $envelope->getInbox();
//
//$inbox->send
//
//// Retrieve the available threads
//$threads = $inbox->getThreads();


//var_dump($feeds);