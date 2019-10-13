<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Mapper\UserMapper;
use App\Domain\User\Model\User;
use App\Repository\QueryFactory;
use App\Repository\RepositoryInterface;
use App\Repository\TableName;
use Cake\Database\StatementInterface;

/**
 * Repository.
 */
final class UserRepository implements RepositoryInterface
{
    /**
     * @var QueryFactory The query factory
     */
    private $queryFactory;

    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Find all users.
     *
     * @return User[] A list of users
     */
    public function findAllUsers(): array
    {
        $query = $this->queryFactory->newSelect(TableName::USERS)->select('*');

        $rows = $query->execute()->fetchAll(StatementInterface::FETCH_TYPE_OBJ);

        $result = [];
        foreach ($rows as $row) {
            $result[] = UserMapper::createFromObject($row);
        }

        return $result;
    }
}
