<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Objetos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class AdvanceSearchController extends Controller {

	/**
	 * @Route("/search", name="advance_search")
	 */
	public function showAction(Request $request) {
		
		// 1 construir el formulario
		$defaultData = array('message' => 'Type here');
		$form = $this->createFormBuilder($defaultData)
		->add ( 'descripcion', 'text', array(
				'required' => false,))
		->add ( 'aval_sn', 'checkbox', array(
				'label'    => 'Necesita aval',
				'required' => false,))
		->add ( 'pagoaplazos_sn', 'checkbox', array(
				'label'    => 'Permite pago fraccionado',
				'required' => false,))
		//segun todos los tipos que hay en base de datos
		->add('idtipo', 'entity', array(
                'class' => 'AppBundle\Entity\TiposObjetos',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'DESC');
                },
                'label' => 'Tipos:',
                'property' => 'nombre',
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ))
         ->add('search', 'submit', array('label' => 'Buscar'))
         ->add('searchAll', 'submit', array('label' => 'Ver todos'))
						->getForm();
		
		$form->handleRequest($request);
		if ($form->isValid() && $form->isSubmitted()) {
			
			//creamos la query con la información de la request
			if ($form->get ( 'search' )->isClicked()) {
				$all = $request->request->all();
				$query_select = "SELECT o FROM AppBundle:Objetos o WHERE ";//WHERE o.disponible_sn = 's' order by o.id desc";
				
				if($all['form']['descripcion']) {
					$query_select = $query_select ." o.descripcion='".$all['form']['descripcion']."'";
				}
				
				//$necesitaAval = $all['form']['aval_sn'];
				//$permitePagoFrac = $all['form']['pagoaplazos_sn'];
				
				
				$tipos = $all['form']['idtipo'];
				if (count($tipos) > 0) {
					$query_select = $query_select ." AND ( ";
					for ($i = 0; $i < count($tipos); $i++) {
						if (count($tipos) > 1 && $i < count($tipos)-1) {
							$query_select = $query_select ." o.idtipo = '". $tipos[$i]."' OR ";
						} else {
							$query_select = $query_select ." o.idtipo = '". $tipos[$i]."' ";
						}
					}
					$query_select = $query_select.")";
				}
				
				try {
					// 3 hacemos la query de la búsqueda
					$result = $this->getDoctrine ()->getManager ()->createQuery($query_select);
					$busqueda = $result->getResult();
				} catch (ORMException $ex) {
					$this->addFlash('notice', 'Se ha producido un error al crear el usuario');
					$this->addFlash('error', $ex->getMessage());
				}
			} else if ($form->get ( 'searchAll' )->isClicked()) {
				try {
					// 3 hacemos la query de la búsqueda
					$busqueda = $this->getDoctrine()
					->getRepository('AppBundle:Objetos')
					->findAll();
				} catch (ORMException $ex) {
					$this->addFlash('notice', 'Se ha producido un error al crear el usuario');
					$this->addFlash('error', $ex->getMessage());
				}
			}
			
			return $this->render(
					':Search:results.html.php',
					array('objetos' => $busqueda)
					);
		}
		
		$usr = $this->get('security.token_storage')->getToken()->getUser();
				
		$this->addFlash(
				'notice',
				'caca'//$usr->getNombre()
				);
		
		return $this->render(
				':Search:search.html.php',
				array('form' => $form->createView())
				);
	}
}