<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 09:50
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\entity\Generated\Unities;
use buvette\Form\Type\UnityType;


class UnitiesController extends AbstractController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $unities = $this->getUnitiesEM($app)->findAll();

        return $app['twig']->render('unities/index.html.twig', array(
            'unities' => $unities
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function addAction(Request $request, Application $app)
    {
        $unity     = new Unities();
        $unityForm = $this->getFormFactory($app)->create(new UnityType(), $unity);
        $unityForm->handleRequest($request);

        if($this->formRequestAction($unityForm)){
            $this->getUnitiesEM($app)->createEntity($unityForm->getData());
            $app['session']->getFlashBag()->add('success', 'The unity '. $unityForm->getData()->getTitle().' was successfully created.');

        }
        $unities = $this->getUnitiesEM($app)->findAll();

        return $app['twig']->render('unities/addUnities.html.twig', array(
            'unityForm' => $unityForm->createView(),
            'unities'   => $unities,
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $unityId
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $unityId){

        $unity = $this->getUnitiesEM($app)->findOneById($unityId);

        $unityForm = $this->getFormUnity($app, $unity);

        $unityForm->handleRequest($request);
        if($this->formRequestAction($unityForm)){
            $this->getUnitiesEM($app)->updateEntity($unityForm->getData());
            $app['session']->getFlashBag()->add('success', 'The unity '. $unityForm->getData()->getTitle().' was successfully updated.');
            return $app->redirect('/buvette/web/unities/addUnity');
        }
        $unities = $this->getUnitiesEM($app)->findAll();

        return $app['twig']->render('unities/addUnities.html.twig', array(
            'unityForm' => $unityForm->createView(),
            'unities'   => $unities,
        ));
    }

    /**
     * @param Application $app
     * @param             $unityId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUnityAction(Application $app, $unityId) {

        $unity = $this->getUnitiesEM($app)->findOneById($unityId);
        if($unity){
            $this->getUnitiesEM($app)->deleteEntity($unity);
            $app['session']->getFlashBag()->add('success', 'The unity '.$unity->getTitle().' was succesfully removed.');
        }

        return $app->redirect('/buvette/web/unities/addUnity');

    }
    /** ========== METHOD ========= **/

    /**
     * @param Application $app
     * @param Unities     $entity
     *
     * @return \Symfony\Component\Form\Form
     */
    public function getFormUnity(Application $app, Unities $entity){

        return $this->getFormFactory($app)->create(new UnityType(), $entity);
    }

    /** ========== SERVICE ========= **/
    /**
     * @param $app
     *
     * @return \buvette\ZEM\Generated\UnitiesZEM
     */
    private function getUnitiesEM($app){

        return $app['EM']->get('UnitiesZEM');
    }


}