<?php
declare(strict_types=1);

namespace App\Domain\Dealer;

interface DealerRepository
{
    /**
     * @return Dealer[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Dealer
     * @throws DealerNotFoundException
     */
    public function findUserOfId(int $id): Dealer;
}
