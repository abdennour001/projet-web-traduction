<?php

require_once "config/Model.php";


class PieceJointe extends Model {

    protected $table = 'piece_jointe';
    protected $primaryKey = 'id_piece_jointe';

    protected $fillable = ['id_traducteur', 'type', 'path', 'description'];

    /**
     * @return mixed
     */
    public function traducteur() {
        return $this->belongsTo('Traducteur', 'id_traducteur');
    }
}
