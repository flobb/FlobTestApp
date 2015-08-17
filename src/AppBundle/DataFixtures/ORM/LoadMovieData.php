<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\movie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LoadMovieData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // Load movies data from YML
        $moviesData = Yaml::parse(file_get_contents(realpath(dirname(__FILE__).'/../YML/movies.yml')));

        foreach ($moviesData as $movieData) {
            $movie = new Movie();
            $movie
                ->setTitle($movieData['title'])
                ->setSynoptic($movieData['synoptic'])
            ;

            if (!empty($movieData['publishedAt'])) {
                $movie->setPublishedAt(new \DateTime($movieData['publishedAt']));
            }

            if (!empty($movieData['directors'])) {
                foreach ($movieData['directors'] as $director) {
                    $movie->addDirector($this->getReference('Person.'.$director));
                }
            }

            if (!empty($movieData['actors'])) {
                foreach ($movieData['actors'] as $actor) {
                    $movie->addActor($this->getReference('Person.'.$actor));
                }
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 40;
    }
}
