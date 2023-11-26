<?php

class Usuario extends Model {

    protected static $tableName = 'usuarios';
    protected static $columns = [
        "id",
        "nome",
        "email",
        "senha"
    ];

    public function insert()
    {
        return parent::insert();
    }
}
