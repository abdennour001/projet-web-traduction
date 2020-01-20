<?php

require_once "config/Model.php";


class Devis extends Model {

    protected $table = 'devis';
    protected $primaryKey = 'id_devis';

    protected $fillable = ['type_traduction', 'commentaires'
    , 'etat', 'traducteur_assermente', 'date', 'id_langue_source', 'id_langue_destination', 'id_client', 'id_document'];

    /**
     * @return mixed
     */
    public function document() {
        return $this->hasOne('Document','id_devis');
    }

    /**
     * @return mixed
     */
    public function langueSource() {
        return $this->hasOneThrough('Langue', 'id_langue_source');
    }

    public function langueDestination() {
        return $this->hasOneThrough('Langue', 'id_langue_destination');
    }
}
