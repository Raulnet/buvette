<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 30/05/15
 * Time: 16:34
 */


$event = $app['controllers_factory'];

/* Route index Event */
$event->get('/', "buvette\Controller\EventController::indexAction")->bind('event');
/* Route add Event */
$event->match('/addEvent', "buvette\Controller\EventController::addAction")->bind('addEvent');
/* Route Delete Event */
$event->get('/deleteEvent/{eventId}', "buvette\Controller\EventController::deleteEventAction")->bind('deleteEvent');


/**
 * @return mount event
 */
return $event;

