<?php

require_once "config/Model.php";

class TraducteurDevis extends Model {

    protected $table = 'traducteur_devis';
    protected $primaryKey = 'id_traducteur_devis';

    protected $fillable = ['id_traducteur', 'id_devis'];

}
