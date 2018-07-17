<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Buyer;
use Addressable\Bundle\Form\Type\AddressMapType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("@App/page.html.twig")
     */
    public function indexAction(Request $request)
    {
        $entity = new Buyer();
        $form = $this->createForm(AddressMapType::class, $entity, [
            'google_api_key' => 'yourKeyHere',
        ]);
    
        return [
            'form' => $form->createView(),
        ];
    }
}
