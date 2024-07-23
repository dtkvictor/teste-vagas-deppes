<?php 

namespace App\Http\Filters;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Name extends QueryFilter
{
    protected Builder $builder;
    protected array $searchBy = [];
    protected array $orderBy = [];
    protected array $hiddenMethod = [];
}