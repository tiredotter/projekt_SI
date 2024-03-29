<?php
/**
 * Note fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class NoteFixtures.
 */
class NoteFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'notes', function (int $i) {
            $note = new Note();

            $note->setTitle($this->faker->unique()->word);

            $note->setContent($this->faker->paragraphs(2, true));

            $note->setCreatedAt(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );

            $note->setUpdatedAt(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );

            /** @var Category $category */
            $category = $this->getRandomReference('categories');
            $note->setCategory($category);

            /** @var User $author */
            $author = $this->getRandomReference('users');
            $note->setAuthor($author);

            $tags = $this->getRandomReferences('tags', 3);
            foreach ($tags as $tag) {
                $note->addTag($tag);
            }

            return $note;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: CategoryFixtures::class}
     */
    public function getDependencies(): array
    {
        return [CategoryFixtures::class, UserFixtures::class];
    }
}
