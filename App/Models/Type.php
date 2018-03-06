<?php

namespace App\Model;

use \Core\Connection;
use \Core\Helper;

class Type
{

    /**
     * Connection
     * @var Connection
     */
    private $table;

    /**
     * All table fields
     * @var array
     */
    private $fields;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = Connection::get()->table('types');
        $this->fields = ['name', 'type', 'value', 'desc'];
    }

    /**
     * Get by id
     * @param string id
     * @return object
     */
    public function get($id)
    {
        return $this->table->where('type_id', '=', $id)->get();
    }

    /**
     * Get by type
     * @param string type
     * @return object
     */
    public function getByType($type)
    {
        return $this->table->where('type', '=', $type)->get();
    }

    /**
     * Get by name
     * @param string name
     * @return object
     */
    public function getByName($name)
    {
        return $this->table->where('name', '=', $name)->get();
    }

    /**
     * Create type
     * @param array fields
     * @return bool
     */
    public function create($data)
    {
        $insert = [];
        foreach ($this->fields as $field)
        {
            if (isset($data[$field]))
            {
                $insert[$field] = $data[$field];
            }
        }

        $insert['created_at'] = Helper::getCurrentDate();
        $update['updated_at'] = Helper::getCurrentDate();

        $this->table->insert($insert);
        return true;
    }

    /**
     * Update type
     * @param string id
     * @param array fields
     * @return bool
     */
    public function update($id, $data)
    {
        $update = [];
        foreach ($this->fields as $field)
        {
            if (isset($data[$field]))
            {
                $update[$field] = $data[$field];
            }
        }

        $update['updated_at'] = Helper::getCurrentDate();

        $this->table->where('type_id', '=', $id)->update($update);
        return true;
    }

    /**
     * Delete type
     * @param string id
     * @return bool
     */
    public function delete($id)
    {
        $this->table->where('type_id', '=', $id)->delete();
        return true;
    }

}