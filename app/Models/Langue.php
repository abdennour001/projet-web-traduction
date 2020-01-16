<?php


class Langue extends Model {

    protected $table = 'langue';
    protected $primaryKey = 'id_langue';

    protected $fillable = ['nom', 'description'];

    public function Traducteurs() {
        return $this->belongsToMany('Traducteur', 'traducteur_langue', 'id_traducteur');
    }

}
