<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Book;

class AddBookCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('book:add')
            ->setDescription('Add a book')
            ->addArgument(
                'title',
                InputArgument::REQUIRED,
                'Set title for book'
            )
            ->addArgument(
                'locationId',
                InputArgument::REQUIRED,
                'Set locationId where book is located'
            );;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $location = $em->getRepository('AppBundle:Location')->find($input->getArgument('locationId'));
        $book = new Book();
        $book->setTitle($input->getArgument('title'));
        $book->setLocation($location);
        $em->persist($book);
        $em->flush();
        $output->writeln('Book with title "'.$book->getTitle().'" for location "'.$location->getName().'" added.');
    }
}
