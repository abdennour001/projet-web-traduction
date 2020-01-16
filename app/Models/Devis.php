<?php

require_once "config/Model.php";


class Devis extends Model {

    protected $table = 'devis';
    protected $primaryKey = 'id_devis';

    protected $fillable = ['nom', 'prenom', 'email', 'numero', 'adresse', 'type_traduction', 'commentaires'
    , 'etat', 'traducteur_assermente', 'date'];

    /**
     * @return mixed
     */
    public function document() {
        return $this->hasOne('Document','id_devis');
    }
}
