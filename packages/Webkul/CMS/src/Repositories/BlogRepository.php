<?php

namespace Webkul\CMS\Repositories;

use Webkul\Core\Eloquent\Repository;

class BlogRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model(): string
    {
        return 'Webkul\CMS\Contracts\Blog';
    }
}
