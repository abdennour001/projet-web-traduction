<?php

require_once "config/Model.php";


class Traducteur extends Model {

    protected $table = 'traducteur';
    protected $primaryKey = 'id_traducteur';

    protected $fillable = ['id_traducteur', 'est_assermente', 'est_approuve'];


    /**
     * Get the user model of this client.
     */
    public function user() {
        return $this->belongsToMaster('User');
    }

    /**
     * @return mixed
     */
    public function piecesJointe() {
        return $this->hasMany("PieceJointe", "id_traducteur");
    }

    /**
     * @return mixed
     */
    public function langues() {
        return $this->belongsToMany("Langue", "traducteur_langue", "id_langue");
    }

    public function demande() {
        return $this->hasOne("Demande", "id_traducteur");
    }

    public function devis() {
        return $this->hasMany("Devis", "id_traducteur");
    }

}
