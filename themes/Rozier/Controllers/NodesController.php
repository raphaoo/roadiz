<?php 
/**
 * Copyright REZO ZERO 2014
 * 
 * 
 * 
 *
 * @file NodesController.php
 * @copyright REZO ZERO 2014
 * @author Ambroise Maupate
 */
namespace Themes\Rozier\Controllers;

use RZ\Renzo\Core\Kernel;
use Themes\Rozier\RozierApp;
use Symfony\Component\HttpFoundation\Response;


class NodesController extends RozierApp {
	
	public function indexAction()
	{
		$nodes = Kernel::getInstance()->em()
			->getRepository('RZ\Renzo\Core\Entities\Node')
			->findAll();

		$this->assignation['nodes'] = $nodes;

		return new Response(
		    $this->getTwig()->render('nodes.html.twig', $this->assignation),
		    Response::HTTP_OK,
		    array('content-type' => 'text/html')
		);
	}

	public function noAction()
	{
		return $this->throw404();
	}

	public function editAction( $node_id, $translation_id = null )
	{
		$node = Kernel::getInstance()->em()
			->find('RZ\Renzo\Core\Entities\Node', (int)$node_id);

		if ($node !== null) {
			$this->assignation['node'] = $node;

			return new Response(
			    $this->getTwig()->render('node/edit.html.twig', $this->assignation),
			    Response::HTTP_OK,
			    array('content-type' => 'text/html')
			);
		}
		else {
			return $this->throw404();
		}
	}
}