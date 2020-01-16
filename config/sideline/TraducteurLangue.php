<?php


class TraducteurLangue extends Model {

    protected $table = 'traducteur_langue';
    protected $primaryKey = 'id_traducteur_langue';

    protected $fillable = ['id_traducteur', 'id_langue'];

}
