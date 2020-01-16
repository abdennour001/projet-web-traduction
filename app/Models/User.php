<?php

require_once "config/Model.php";


class User extends Model {

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['nom', 'prenom', 'email', 'numero', 'adresse'];

    /**
     * Get the client model associated to the this user, if there is one.
     */
    public function client() {
        return $this->hasSlave('Client');
    }

    /**
     * Get the traducteur model associated to the this user, if there is one.
     */
    public function traducteur() {
        return $this->hasSlave('Traducteur');
    }

}
