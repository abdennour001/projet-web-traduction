<?php

require_once "config/Model.php";


class Document extends Model {

    protected $table = 'document';
    protected $primaryKey = 'id_document';

    protected $fillable = ['path', 'date', 'id_devis'];

    /**
     * @return mixed
     */
    public function devis() {
        return $this->belongsTo('Devis');
    }

    /**
     * @return mixed
     */
    public function traduction() {
        return $this->belongsTo("Traduction", "id_document");
    }
}
