<?php
/**
 * Category service interface.
 */

namespace App\Service;

use App\Entity\Category;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface CategoryServiceInterface.
 */
interface CategoryServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save category.
     * 
     * @param Category $category Category entity
     */
    public function save(Category $category): void;

    /**
     * Delete category.
     * 
     * @param Category $category Category entity
     */
    public function delete(Category $category): bool;

    /**
     * Can Category be deleted?
     *
     * @param Category $category Category entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Category $category): bool;

    /**
     * Find category by ID.
     * 
     * @param int $id id
     */
    public function findOneById(int $id): ?Category;
}
