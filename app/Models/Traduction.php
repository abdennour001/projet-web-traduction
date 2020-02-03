<?php


class Traduction extends Model {

    protected $table = 'traduction';
    protected $primaryKey = 'id_traduction';

    protected $fillable = ['etat', 'date', 'note', 'id_devis', 'id_document'];

    /**
     * @return mixed
     */
    public function devis() {
        return $this->belongsTo("Devis", "id_devis");
    }

    /**
     * @return mixed
     */
    public function document() {
        return $this->hasOneThrough('Document','id_document');
    }

}
