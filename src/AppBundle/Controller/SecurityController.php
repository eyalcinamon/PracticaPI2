<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller {
	
	/**
	 * @Route("/login", name="login_route")
	 */
	public function loginAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');
		
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
		
		return $this->render(
				':Security:login.html.php',//'security/login.html.php',
				array(
						// last username entered by the user
						'last_username' => $lastUsername,
						'error'         => $error,
				)
				);
	}
	
	/**
	 * @Route("/login_check", name="login_check")
	 */
	public function loginCheckAction()
	{
		// this controller will not be executed,
		// as the route is handled by the Security system
	}
	
	/**
	 * @Route("/logout", name="logout")
	 */
	public function logoutAction()
	{
		$this->container->get('security.context')->setToken(null);
		$this->container->get('session')->invalidate();
		return $this->redirectToRoute('homepage');
	}
}