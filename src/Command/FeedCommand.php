<?php

namespace App\Command;

use App\Entity\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class FeedCommand extends Command implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Doctrine\ORM\EntityManager $manager */
        $manager = $this->container->get("doctrine.orm.entity_manager");
        if ($input->getArgument("action") == 'feed') {
            $output->writeln("start feeding the db");

            $items = [
                ['metallica', 'ticket for the 2019 tour', 80],
                ['sepultura', 'ticket for the 2020 tour', 67],
                ['iron maiden', 'ticket for the 2019 super cool tour', 30],
            ];

            foreach ($items as $item) {
                $entity = new Product($item[0], $item[1], $item[2]);
                $manager->persist($entity);
            }

            $manager->flush();
        } else {
            $output->writeln("start reading the db");
            foreach ($manager->getRepository(Product::class)->findAll() as $product) {
                $output->writeln($product);
            }
        }
    }

    protected function configure()
    {
        $this->setName("app:db")->addArgument("action", InputArgument::REQUIRED);
    }
}