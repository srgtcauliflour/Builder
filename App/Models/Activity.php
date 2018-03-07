<?php

namespace App\Model;

use \Core\Connection;
use \Core\Helper;

class Activity
{

    private $table;
    private $fields;

    public function __construct()
    {
        $this->table = Connection::get()->table('activites');
        $this->fields = ['type_id', 'parent_type', 'parent_id', 'name', 'value'];
    }

    /**
     * Get by id
     * @param string id
     * @return object
     */
    public function get($id)
    {
        return $this->table->where('activity_id', '=', $id)->get();
    }

    /**
     * Get by type
     * @param string type
     * @return object
     */
    public function getByType($type)
    {
        return $this->table->where('type_id', '=', $type)->get();
    }

    public function getByName($name)
    {
        return $this->table->where('name', '=', $name)->get();
    }

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
        $insert['updated_at'] = Helper::getCurrentDate();

        $this->table->insert($insert);
        return true;
    }

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

        $this->table->where('activity_id', '=', $id)->update($update);
        return true;
    }

    public function delete($id)
    {
        $this->table->where('activity_id', '=', $id)->delete();
        return true;
    }

}