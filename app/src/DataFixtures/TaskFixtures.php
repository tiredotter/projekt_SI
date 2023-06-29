<?php
/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Task;
use DateTimeImmutable;

/**
 * Class TaskFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class TaskFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(50, 'tasks', function (int $i) {
            
            $task = new Task();
            
            $task->setTitle($this->faker->unique()->word);

            $task->setContent($this->faker->paragraphs(1, true));
            
            $task->setCreatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            
            $task->setUpdatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );

            return $task;
        });

        $this->manager->flush();
    }
}
