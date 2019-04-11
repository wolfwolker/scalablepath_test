<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @Route("/", name="product_list")
     */
    public function listAction()
    {
        $products = $this->getManager()->getRepository(Product::class)->findBy(['deleted' => false]);

        /** @var \Symfony\Bridge\Twig\TwigEngine $twig */
        $twig = $this->container->get("twig");

        return new Response($twig->render("base.html.twig", ['products' => $products]));
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     */
    public function deleteAction($id)
    {
        $entityManager = $this->getManager();
        if ($product = $entityManager->find(Product::class, $id)) {
            $product->setDeleted(true);
            $entityManager->flush();
        }

        return new RedirectResponse($this->container->get("router")->generate("product_list"));
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getManager()
    {
        return $this->container->get("doctrine.orm.entity_manager");
    }
}
