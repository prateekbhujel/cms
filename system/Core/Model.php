<?php

namespace System\Core;
use System\Database\DB;
use System\Exceptions\NotFoundException;

abstract class Model extends DB 
{
    /** Name of  database table*/
    protected string $table;

    /** Name of  primary key */
    protected string $pk= 'id';

    /**Names of selected columns */
    private string $columns = '*';

    /**Conditions for db query */
    private ?string $conditions = null;

    /**Sorting order for  */
    private ?string $order = null;

    /**Limit for no. of data from db result */
    private ?string $limit = null;
     
    /** Db query to be executed */
    private ?string $query = null;

    /** Data for relational db query */
    private $related = [];

    /**Data variables */
    protected $attributes = [];

    /**Chek if data is loaded in the model from the db */
    protected $loaded = false;

    /**Handles data set in dynamic properties */
    public function __set($name, $value){
        $this->attributes[$name] = $value;
    }

    /**Handles data read from dynamic properties */
    public function __get($name){
        if(key_exists($name, $this->attributes)){
            return $this->attributes[$name];
        }
    }
    
    public function __construct($id=null){
        parent::__construct();
        
        if(!is_null($id)){
            $this->load($id);
        }
    }

    /** Sets columns to be selected in the select query.*/
    public function select(string ...$columns): self 
    {
        if(!empty($columns)){
            $this->columns = implode(', ', $columns);
        }
        return $this;
    }

    /** 
    * Sets condition for db query.
    */
    public function where(string $columns, $operator, $value = null): self 
    {
        if(is_null($value)){
            $temp = "$columns = '$operator'";
        }
        else{
            $temp = "$columns $operator '$value'";
        }

        if(is_null($this->conditions)){
            $this->conditions = $temp;
        }
        else{
            $this->conditions .=" AND $temp";
        }
        return $this;
    }

    public function orWhere(string $columns, $operator, $value = null): self
    {
        if(is_null($value)){
            $this->conditions .= " OR $columns = '$operator'";
        }
        else{
            $this->conditions .=" OR $columns  $operator '$value'";
        }
        return $this;
    }

    

    /**
     * Sets sorting order for the db result
     */
    public function orderBy(string $columns, string $direction = 'ASC')
    {
        if(is_null($this->order)){
            $this->order = "$columns $direction";
        }
        else{
            $this->order .= ", $columns $direction";
        }
        return $this;
    }

    /**
     * Sets limit of data for db result
     */
    public function limit(int $offset, ?int $count = null): self
    {
        if(is_null($count)){
            $this->limit = "0, $offset";
        }
        else{
            $this->limit= " $offset, $count";
        }
        return $this;
    }

    /**Executes select query and returns data */
    public function get():array
    {
       $this->buildSelect();
       $this->run($this->query);
       $this->resetVars();

       $result = $this->fetch();

       $class = $this->related['class'] ?? get_class($this);

        $collection = [];
        foreach($result as $item){
            $obj = new $class;
            // dump($item);

            foreach($item as $k=>$v){
                $obj->{$k} = $v;
                // dump("$k=$v");
            }

            $obj->setLoaded(true);

            // dump($obj);
            $collection[] = $obj;
        }
        return  $collection;
    }

    /**Exeutes db query and returns first data */
    public function first(): ?Model
    {
        $this->limit(1);
        $result = $this->get();

        if(!empty($result)){
            return $result[0];
        }
        else{
            return null;
        }
    }

    /**Loads data for the given id in the current object */
    public function load($id)
    {
        $this->where($this->pk, $id);
        $this->buildSelect();
        $this->run($this->query);
        $this->resetVars();

        $result = $this->fetch();

        if($this->count()==1){
            foreach($result[0] as $k=>$v){
                $this->{$k} = $v;
            }
            $this->setLoaded(true);
        }
        else{
            throw new NotFoundException("Data not found for the id ".$id);
        }
    }
    
    /** 
     * Build an relation for the specific Models.
    */
    public function relation(string $class, string $table, string $fk, string $type = 'child', string $pk='id'): self 
    {
        $this->related = compact('class', 'table');

        if($type =='child'){
            $this->where($fk, $this->{$pk});
        }
        else{
            $this->where($pk, $this->{$fk});
        }
        return $this;
    }

    /** 
     * Saves the data either for Update or Inserted.
    */
    public function save(){
        if($this->loaded){
            $this->buildUpdate();
        }
        else{
            $this->buildInsert();
        }

        $this->run($this->query);

        if($this->loaded){
            $id = $this->{$this->pk};
        }
        else{
            $id = $this->lastId();
        }
        $this->load($id);
    }

    /**
     * Deletes the Data from DB.
    */
    public function delete()
    {
        $this->query = "DELETE FROM {$this->table} WHERE {$this->pk} = '{$this->{$this->pk}}'";
        $this->run($this->query);
    
        $this->attributes = [];
        $this->setLoaded(false);
    }
    
    /**
     * Returns Paginated data.
    */
    public function paginate(int $perPage = 10): array
    {
        $current = $_GET['page'] ?? 1;

        $table = $this->related['table'] ?? $this->table;

        $sql = "SELECT COUNT(id) as total FROM $table";

        if(!is_null($this->conditions)){
            $sql .= " WHERE {$this->conditions}";
        }

        $this->run($sql);

        $result = $this->fetch();
        $total = $result[0]['total'];

       $pages = ceil($total / $perPage);

       $offset = ($current - 1) * $perPage;

       $this->limit($offset, $perPage);

       $data = $this->get();

       return compact('data', 'pages', 'current');
    }


    /**Sets  value for the loaded variable*/
    public function setLoaded(bool $data)
    {
        $this->loaded = $data;
    }

    /** Builds select db query */
    private function buildSelect(){
        $table = $this->related['table'] ?? $this->table;

        $this->query = "SELECT {$this->columns} FROM {$table} ";

        if(!is_null($this->conditions)){
            $this->query.= " WHERE {$this->conditions}";
        }

        if(!is_null($this->order)){
            $this->query.= " ORDER BY {$this->order}";
        }

        if(!is_null($this->limit)){
            $this->query.= " LIMIT {$this->limit}";
        }
    }

    /**Builds insert db query. */
    private function buildInsert()
    {
       $data = [];
       foreach($this->attributes as $k => $v){
            $data[] = "{$k} = '{$v}'";
       } 
    //    dump($data);
       $this->query = "INSERT INTO {$this->table} SET " .implode(',', $data);
    }

    /** Builds update db query. */
    private function buildUpdate()
    {
        $data = [];
        foreach ($this->attributes as $k => $v) {
            if ($k !== $this->pk) {
                $data[] = "{$k} = '{$v}'";
            }
        }
        $this->query = "UPDATE {$this->table} SET " . implode(',', $data) . " WHERE {$this->pk} = '{$this->{$this->pk}}'";
    }
   
   
    /**Resets the query builder variable. */
    private function resetVars()
    {
        $this->columns = '*';
        $this->conditions = null;
        $this->order = null;
        $this->limit = null;

    }
}
