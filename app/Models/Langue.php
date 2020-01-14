<?php


class Langue extends Model {

    protected $table = 'langue';
    protected $primaryKey = 'id_langue';

    protected $fillable = ['nom', 'description'];

}
