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
use buvette\Domain\Events;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Validator;

class EventController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app) {

        $events = $app['zdao.events']->findAll();

        return $app['twig']->render('event/index.html.twig', array(
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

        $event = new Events();
        $eventForm = $this->getFormFactory($app)->create(new EventType(), $event);

        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {

            $eventForm->getData()->setStaffIdCreate(4);


            $app['zdao.events']->createEntity($eventForm->getData());
            $app['session']->getFlashBag()->add('success', 'The event was successfully created.');

            /**
             * reset form to new creating
             */
            $event = new Events();
            $eventForm = $app['form.factory']->create(new EventType(), $event);
        }

        $events = $app['zdao.events']->findAll();

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


        $event = $app['zdao.events']->findOneById($eventId);
        if($event){
            $app['zdao.events']->deleteEntity($event);
            $app['session']->getFlashBag()->add('success', 'The event was succesfully removed.');
        }

        return $app->redirect('/buvette/web/event/addEvent');

    }

    /**
     * @param Application $app
     *
     * @return Form
     */
    private function getFormFactory(Application $app){

        return $app['form.factory'];
    }

    /**
     * @param Application $app
     *
     * @return Validator
     */
    private function getValidator(Application $app) {

        return $app['validator'];
    }

}