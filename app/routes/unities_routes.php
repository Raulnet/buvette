<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 09:44
 */
$unities = $app['controllers_factory'];

/* Route index Event */
$unities->get('/', "buvette\Controller\UnitiesController::indexAction")->bind('unities');
/* Route add Event */
$unities->match('/addUnity', "buvette\Controller\UnitiesController::addAction")->bind('addUnity');
/* Route Delete Event */
$unities->get('/deleteUnity/{unityId}', "buvette\Controller\UnitiesController::deleteUnityAction")->bind('deleteUnity');

/**
 * @return mount event
 */
return $unities;
