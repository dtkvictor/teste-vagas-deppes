<?php 

namespace App\Http\Filters;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class BookFilter extends QueryFilter
{
    protected Builder $builder;
    protected array $searchBy = ['publisher','title', 'author', 'isbn'];
    protected array $orderBy = ['title', 'created_at'];
    protected array $hiddenMethod = [];

    public function category($input)
    {
        $this->builder->where('category_id', $input);
    }

    public function publisher($input)
    {
        $this->builder->where('publisher','LIKE', "%$input%");
    }
}