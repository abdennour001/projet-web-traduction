<?php

require_once "config/Model.php";


class Admin extends model {

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['login'];

}
