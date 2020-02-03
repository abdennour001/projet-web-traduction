<?php

require_once "config/Model.php";


class Client extends Model {

    protected $table = 'client';
    protected $primaryKey = 'id_client';

    protected $fillable = ['id_client'];


    /**
     * Get the user model of this client.
     */
    public function user() {
        return $this->belongsToMaster('User');
    }

    /**
     *  Get all the devis of this client.
     */
    public function devis() {
        return $this->hasMany("Devis");
    }

}
