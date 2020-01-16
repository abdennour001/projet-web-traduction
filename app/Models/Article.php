<?php

require_once 'config/Model.php';

class Article extends Model {

    protected $table = 'article';
    protected $primaryKey = 'id_article';

    protected $fillable = ['titre', 'corps', 'image_path'];
}
