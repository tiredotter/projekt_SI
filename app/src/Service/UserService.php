<?php
/**
 * This is the license block.
 * It can contain licensing information, copyright notices, etc.
 */
namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use App\Repository\NoteRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * User Service.
 */
class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    private NoteRepository $noteRepository;

    /**
     * Paginator.
     * 

     */
    private PaginatorInterface $paginator;

    /**
     * Constructor
     *
     * @param UserRepository     $userRepository
     * @param PaginatorInterface $paginator
     * @param NoteRepository   $noteRepository
     */
    public function __construct(UserRepository $userRepository, PaginatorInterface $paginator, NoteRepository $noteRepository)
    {
        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
        $this->noteRepository = $noteRepository;
    }

    /**
     * Save user
     *
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    /**
     * Create user
     *
     * @param User $user
     *
     * @return void
     */
    public function create(User $user): void
    {
        $this->userRepository->create($user);
    }

    /**
     * Delete user
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user): bool
    {
        if ($this->canBeDeleted($user)) {
            $this->userRepository->remove($user);

            return true;
        }

        return false;
    }


    /**
     * Can user be deleted?
     *
     * @param User $user
     *
     * @return bool
     */
    public function canBeDeleted(User $user): bool
    {
        try {
            $result = $this->noteRepository->countByUser($user);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->userRepository->queryAll(),
            $page,
            UserRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Find by id.
     *
     * @param int $id User id
     *
     * @return User|null User entity
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }
}