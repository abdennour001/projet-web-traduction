<?php


class Demande extends Model {

    protected $table = 'demande';
    protected $primaryKey = 'id_demande';

    protected $fillable = ['id_traducteur', 'etat', 'date'];

    public function traducteur() {
        return $this->belongsTo("Traducteur");
    }
}
