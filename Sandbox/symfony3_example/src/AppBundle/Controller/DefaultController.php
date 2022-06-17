<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Buyer;
use Addressable\Bundle\Form\Type\AddressMapType;
use Addressable\Bundle\Form\Type\ContactDetailsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("@App/page.html.twig")
     */
    public function indexAction(Request $request)
    {
        $entity = new Buyer();

        // $form = $this->createForm(AddressMapType::class, $entity, [
        //     'google_api_key' => 'yourKeyHere',
        // ]);
        
        $form = $this->createFormBuilder($entity)
            ->add('address', AddressMapType::class, array(
                'google_api_key' => 'yourKeyHere',
            ))
            ->add('contactDetails', ContactDetailsType::class)
            ->add('submit', SubmitType::class, array(
                'validation_groups' => false,
            ))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($entity->getAddress());
            var_dump($entity->getEmail());
            exit;
        }
    
        return [
            'form' => $form->createView(),
        ];
    }
}
