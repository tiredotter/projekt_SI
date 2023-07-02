<?php
/**
 * This is the license block.
 * It can contain licensing information, copyright notices, etc.
 */

namespace App\Service;

use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * User service interface.
 */
interface UserServiceInterface
{
    /**
     * Save user.
     */
    public function save(User $user): void;

    /**
     * Delete user.
     */
    public function delete(User $user): bool;

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Find on by ID.
     */
    public function findOneById(int $id): ?User;

    /**
     * Create user.
     */
    public function create(User $user): void;
}