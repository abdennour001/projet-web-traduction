<?php

require_once "config/Model.php";


class User extends Model {

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['nom', 'prenom', 'email', 'numero', 'adresse'];

}
