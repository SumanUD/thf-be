<?php

namespace Webkul\CMS\Repositories;

use Webkul\Core\Eloquent\Repository;

class RecipeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model(): string
    {
        return 'Webkul\CMS\Contracts\Recipe';
    }
}
