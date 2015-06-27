<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 09:44
 */
$unities = $app['controllers_factory'];

/* Route index Unity */
$unities->get('/', "buvette\Controller\UnitiesController::indexAction")->bind('unities');
/* Route add Unity */
$unities->match('/addUnity', "buvette\Controller\UnitiesController::addAction")->bind('addUnity');
/* Route add Unity */
$unities->match('/editUnity/{unityId}', "buvette\Controller\UnitiesController::editAction")->bind('editUnity');
/* Route Delete Unity */
$unities->get('/deleteUnity/{unityId}', "buvette\Controller\UnitiesController::deleteUnityAction")->bind('deleteUnity');

/**
 * @return mount event
 */
return $unities;
