<?php
/*
    FantasyFootball Symfony2 bundles - Symfony2 bundles collection to handle fantasy football tournament 
    Copyright (C) 2017  Bertrand Madet

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
namespace FantasyFootball\TournamentCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use FantasyFootball\TournamentCoreBundle\Util\DataProvider;

class DefaultController extends Controller
{
	public function indexAction()
	{
		$router = $this->container->get('router');
    	$collection = $router->getRouteCollection();
    	$allRoutes = $collection->all();

    	$routes = array();

    	foreach ($allRoutes as $route => $params)
    	{
			$defaults = $params->getDefaults();

			if (isset($defaults['_controller']))
			{
        		if ( 0 === strncmp($defaults['_controller'],"FantasyFootball\\TournamentCoreBundle",strlen("FantasyFootball\\TournamentCoreBundle") ) ){
        			$routes[$route]=$params->getPath();	
        		}
			}
		}
		$response = new JsonResponse($routes);
		$response->headers->set('Access-Control-Allow-Origin','*');
		return $response;
	}
  
  public function getVersionAction(){
		$response = new JsonResponse(array('version'=>'1.15.0alpha1'));
		$response->headers->set('Access-Control-Allow-Origin','*');
		return $response;
  }
  
  public function getEditionListAction(){
    $conf = $this->get('fantasy_football_core_db_conf');
    $data = new DataProvider($conf);
    $editions = $data->getEditions();
    $exposedEditions = array();
    foreach($editions as $edition){
      $exposedEditions[] = $edition->toArray();
    }
		$response = new JsonResponse($exposedEditions);
		$response->headers->set('Access-Control-Allow-Origin','*');
		return $response;
  }
  
  public function getCurrentEditionAction(){
    $conf = $this->get('fantasy_football_core_db_conf');
    $data = new DataProvider($conf);
    $edition = $data->getCurrentEdition();
		$response = new JsonResponse($edition->toArray());
		$response->headers->set('Access-Control-Allow-Origin','*');
		return $response;
  }
  
}
