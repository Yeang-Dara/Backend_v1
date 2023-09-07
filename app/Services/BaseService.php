<?php
 namespace App\Services;
class BaseService 
{
    protected $model;
    protected $limit= 50;

    public function queryBuilder(){
        return $this->model;
    }
    public function getList() {
        return $this->model->all()->toArray();
        // return $this->model->orderBy('id')->toArray();
    }
    public function getById($id) {
         return $this->model->find($id);
    }
    public function getByWithRelation($id, $relations=[])
    {
        return $this->model->with($relations)->find($id);
    }
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }
    public function updateOrCreate($attributes)
    {
        if (!$attributes) {
            return false;
        }
        return $this->model->updateOrCreate($attributes);
    }
    public function updateById($id, $attribute)
    {
        $modelObj = $this->getById($id);
        if (!$modelObj) {
            return false;
        }
        $result = $modelObj->fill($attribute);
        $result->update();
        return $result;
    }
    public function delete($id)
    {
        $result = $this->model->find($id);
        if ($result instanceof $this->model) {
            $result->delete();
            return $result;
        }
        return false;
    }
    public function getSchemaColumns()
    {
        return $this->model->getTableColumns();
    }
    public function getTableHeader()
    {
        return $this->model->getDetailTableColumns();
    }
    public function getColumnSting()
    {
        $columns = $this->model->getDetailTableColumns();
        foreach ($columns as $column) {
            dd($column);
        }
    }
    public function filter($filters, $query)
    {
        if (!$filters) $filters = [];
        if (count($filters) > 0) {
            foreach ($filters as $filter) {
                $query = $query->where(key($filters), $filter);
                next($filters);
            }
        }
        return $query;
    }
    public function search($keys, $value, $query)
    {

        if (!$keys) $keys = [];
        if (count($keys) > 0 && $value) {
            $query = $query->where(function ($query) use ($value, $keys) {
                foreach ($keys as $key){
                    $query->orWhere($key, 'like', '%' . $value . '%');
                }
            });
        }
        return $query;
    }
    public function getData($attributes, $dbq = null)
    {
        isset($dbq) ? $query = $dbq : $query = $this->model;
        // Check if get limit
        isset($attributes['limit']) ? $this->limit = $attributes['limit'] : $this->limit;
        // Check if get filters
        isset($attributes['filters']) ? $filters = $attributes['filters'] : $filters = [];
        // Check if get keySearch
        isset($attributes['keySearch']) ? $keySearch = $attributes['keySearch'] : $keySearch = [];
        // Check if get search
        isset($attributes['search']) ? $search = $attributes['search'] : $search = null;

        $query = $this->filter($filters, $query);
        $query = $this->search($keySearch, $search, $query);
        $query = $query->paginate($this->limit);
        return $query;
    }
    public function getWithRelation($relations = []){

        return $this->model->with($relations)->orderBy('id')->get();
    }
    
}