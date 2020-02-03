<?php


class Blocked extends Model {

    protected $table = 'blocked';
    protected $primaryKey = 'id_blocked';

    protected $fillable = ['id_user'];

}
