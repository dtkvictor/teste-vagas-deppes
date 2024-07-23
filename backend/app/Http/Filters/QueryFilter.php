<?php 

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter 
{
    protected Builder $builder;
    protected array $searchBy = [];
    protected array $orderBy = [];
    protected array $hiddenMethod = [];    

    public function __construct(Builder $builder)
    {
        $defaultHiddenMethods = [
            'apply',
        ]; 
        
        $this->hiddenMethod = array_merge(
            $defaultHiddenMethods,
            $this->hiddenMethod
        );

        $this->builder = $builder;
    }

    public function apply(array $filters): Builder
    {
        foreach($filters as $filter => $param)
        {
            (string) $filter = Str::camel($filter);

            if(in_array($filter, $this->hiddenMethod)) continue;
            if(method_exists($this, $filter) && !empty($param))
            {
                call_user_func_array([$this, $filter], [$param]);
            }
        }
        return $this->builder;
    }

    protected function search(string $input): void
    {
        (string) $input = str_replace('-', ' ', $input);

        foreach(array_values($this->searchBy) as $key => $search)
        {
            if($key > 0) {
                $this->builder->orWhere($search, 'LIKE', "%$input%");
            }else {
                $this->builder->where($search, 'LIKE', "%$input%");
            }
        } 
    }

    public function order(string $input): void
    {
        (array) $order = explode(',', $input);
        (array) $supported = ['asc', 'desc'];

        foreach($order as $value) 
        {
            (array) $query = explode('.', $value);
            if(count($query) > 1) 
            {
                (string) $key = $query[0];
                (string) $value = Str::lower($query[1]);

                if(in_array($value, $supported)) {
                    $this->builder->orderBy($key, $value);
                }
            }            
            return;            
        }
    }
}