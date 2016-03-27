<?php

class Model
{
    /**
     * @var Db
     */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct($db = null)
    {
        $this->db = $db;
    }
}