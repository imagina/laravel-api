<?php

namespace Modules\Iinventory\Repositories\Cache;

use Modules\Iinventory\Repositories\TransactionRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheTransactionDecorator extends CoreCacheDecorator implements TransactionRepository
{
    public function __construct(TransactionRepository $transaction)
    {
        parent::__construct();
        $this->entityName = 'iinventory.transactions';
        $this->repository = $transaction;
    }
}
