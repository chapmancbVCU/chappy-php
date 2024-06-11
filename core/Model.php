<?php
#[AllowDynamicProperties]
class Model {
    protected $_db;
    protected $_table;
    protected $_modelName;
    protected $_softDelete = false;
    protected $_columnNames = [];
    public $id;

    public function __construct($table) {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_setTableColumns();

        /* Replace table name under scores with a space and use ucwords upper case each word 
         * of model and replaces all spaces with no space. 
         * 
         * $table = 'user_sessions => User Sessions => UserSessions
         */
        $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', '', $this->_table)));
    }

    /**
     * Take POST array and assign it to our object.  Sanitize values 
     * before saving.
     */
    public function assign($params) {
        if(!empty($params)) {
            foreach($params as $key => $val) {
                if(in_array($key, $this->_columnNames)) {
                    $this->$key = sanitize($val);
                }
            }

            return true;
        }
        return false;
    }

    /**
     * Grab object and if we just need data for smaller result set.
     */
    public function data() {
        $data = new stdClass();
        foreach($this->_columnNames as $column) {
            $data->column = $this->column;
        }
        return $data;
    }

    /**
     * Wrapper for database delete function.  If not softDelete we set it.
     * If row is set to softDelete we call the database delete function.
     */
    public function delete($id = '') {
        if($id == '' && $this->id == '') return false;
        $id = ($id == '') ? $this->id : $id;
        if($this->_softDelete) {
            return $this->update($id, ['deleted' => 1]);
        }

        return $this->_db->delete($this->_table, $id);
    }

    /**
     * Gets columns from table.
     */
    public function getColumns() {
        return $this->_db->getColumns($this->_table);
    }

    
    public function find($params = []) {
        $params = $this->_softDeleteParams(($params));
        $results = [];
        $resultsQuery = $this->_db->find($this->_table, $params);

        if(!$resultsQuery) return [];
        
        foreach($resultsQuery as $result) {
            $obj = new $this->_modelName($this->_table);
            $obj->populateObjData($result);
            $results[] = $obj;
        }
        return $results;
    }

    public function findById($id) {
        return $this->findFirst(['conditions'=>"id = ?", 'bind' => [$id]]);
    }

    public function findFirst($params = []) {
        $params = $this->_softDeleteParams(($params));
        $resultQuery = $this->_db->findFirst($this->_table, $params);
        $result = new $this->_modelName($this->_table);
        if($resultQuery) {
            $result->populateObjData($resultQuery);
        }
        return $result;
    }

    /** 
     * Wrapper for database insert function.
     */
    public function insert($fields) {
        if(empty($fields)) return false;
        return $this->_db->insert($this->_table, $fields);
    }

    protected function populateObjData($result) {
        foreach($result as $key => $val) {
            $this->$key = $val;
        }
    }

    /**
     * Wrapper for database delete function.
     */
    public function query($sql, $bind) {
        return $this->_db->query($sql, $bind);
    }

    /**
     * Wrapper for update and insert functions.
     */
    public function save() {
        $fields = [];
        foreach($this->_columnNames as $column) {
            $fields[$column] = $this->$column;  // $column so property is a variable property
        }

        // Determine whether to update or insert.
        if(property_exists($this, 'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    /**
     * Grab all columns and set properties up on class.
     */
    protected function _setTableColumns() {
        $columns = $this->getColumns();
        //dnd($columns);
        foreach($columns as $column) {
            $columnName = $column->Field;           // Field property of column
            $this->_columnNames[] = $columnName;
            $this->{$columnName} = null;
        }
    }

    protected function _softDeleteParams($params) {
        if($this->_softDelete) {
            if(array_key_exists('conditions', $params)) {
                if(is_array($params['conditions'])) {
                    $params['conditions'][] = "deleted != 1";
                } else {
                    $params['conditions'] .= " AND deleted != 1";
                }
            } else {
                $params['conditions'] = "deleted != 1";
            }
        }
        return $params;
    }

    public function update($id, $fields) {
        if(empty($fields) || $id = '') return false;
        return $this->_db->update($this->_table, $id, $fields);
    }
}