<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // Load users data from YML
        $articlesData = Yaml::parse(file_get_contents(realpath(dirname(__FILE__).'/../YML/articles.yml')));

        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article
                ->setTitle($articleData['title'])
                ->setContent($articleData['content'])
                ->setAuthor($this->getReference('User.'.$articleData['author']))
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
            ;

            if (!empty($articleData['publishedAt'])) {
                $article->setPublishedAt(new \DateTime($articleData['publishedAt']));
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
