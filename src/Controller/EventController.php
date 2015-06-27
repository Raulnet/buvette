<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 30/05/15
 * Time: 16:33
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Form\Type\EventType;
use buvette\Entity\Generated\Event;

class EventController extends AbstractController {

    /* ========== ACTION CONTROLLER ========== **/

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app) {

        $events = $this->getEvent($app)->findAll();

        return $this->getTwig($app)->render('event/index.html.twig', array(
            'events'            => $events,

        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function addAction(Request $request, Application $app) {

        $event = new Event();
        $eventForm = $this->getFormFactory($app)->create(new EventType(), $event);

        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {

            $eventForm->getData()->setStfIdCreat(5);

            $this->getEvent($app)->createEntity($eventForm->getData());
            $app['session']->getFlashBag()->add('success', 'The event was successfully created.');

        }

        $events = $this->getEvent($app)->findAll();

        return $app['twig']->render('event/addEvent.html.twig', array(
            'eventForm'  => $eventForm->createView(),
            'events'     => $events,
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $eventId) {

        $event = $this->getEvent($app)->findOneById($eventId);

        $eventForm = $this->getFormFactory($app)->create(new EventType(), $event);

        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {

            $this->getEvent($app)->updateEntity($eventForm->getData());
            $app['session']->getFlashBag()->add('success', 'The event was successfully updated.');
        }

        $events = $this->getEvent($app)->findAll();

        return $app['twig']->render('event/addEvent.html.twig', array(
            'eventForm'  => $eventForm->createView(),
            'events'     => $events,
        ));
    }

    /**
     * @param Application $app
     * @param             $eventId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteEventAction(Application $app, $eventId) {

        $em = $this->getEvent($app);

        if($this->deleteEntity($em, $eventId)){

            $app['session']->getFlashBag()->add('success', 'The event was succesfully removed.');
        }
        else {
            $app['session']->getFlashBag()->add('danger', 'The event '. $eventId.'can\'t be removed.');
        }
        return $app->redirect('/buvette/web/event/addEvent');

    }

    /* ========== METHOD CONTROLLER ========== **/



    /* ========== SERVICE CONTROLLER ========== **/

    /**
     * @param $app
     *
     * @return \buvette\ZEM\Generated\EventZEM
     */
    private function getEvent($app){

        return $app['EM']->get('EventZEM');
    }


}