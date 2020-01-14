<?php

require_once 'database/ConnexionDB.php';


abstract class Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;


    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $attributes = [];

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    public function __construct() {
        $this->fetchTableStructure();
    }

    /**
     *
     * Get all the models in the database.
     *
     * @return array
     */
    public static function all() {
        $resultArray = [];
        $self = new static;
        try {
            $conn = ConnexionDB::get_connexion();

            $stmt = $conn->prepare("SELECT * FROM " . $self->table);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $_resultArray = $stmt->fetchAll();
            foreach ($_resultArray as $row) {
                $model = new static;
                foreach ($row as $k => $v) {
                    $model->{$k} = $v;
                }
                array_push($resultArray, $model);
            }

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            echo "Can't run statement : " . $e->getMessage();
        }
        return $resultArray;
    }

    /**
     *
     * Get the row with $id.
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {
        $resultModel = null;
        $self = new static;

        try {
            $conn = ConnexionDB::get_connexion();

            $stmt = $conn->prepare("SELECT * FROM " . $self->table . " WHERE ".$self->primaryKey .
                " = " . $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $_resultArray = $stmt->fetchAll();
            foreach ($_resultArray as $row) {
                $model = new static;
                foreach ($row as $k => $v) {
                    $model->{$k} = $v;
                }
                $resultModel = $model;
            }

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            echo "Can't get data : " . $e->getMessage();
        }
        return $resultModel;
    }

    public static function where($conditions) {
        $resultArray = [];
        $self = new static;
        try {
            $conn = ConnexionDB::get_connexion();

            $query = "SELECT * FROM " . $self->table . " WHERE ";
            foreach ($conditions as $k=>$v) {
                if (!is_numeric($k)) {
                    $query .= $k . " = '" . $v . "'";
                } else {
                    $query .= " " . $v . " ";
                }
            }

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $_resultArray = $stmt->fetchAll();
            foreach ($_resultArray as $row) {
                $model = new static;
                foreach ($row as $k => $v) {
                    $model->{$k} = $v;
                }
                array_push($resultArray, $model);
            }

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            echo "Can't get data : " . $e->getMessage();
        }
        return $resultArray;
    }

    /**
     *
     * Save this instance to the database.
     *
     * @return mixed
     */
    public function save() {
        try {
            $conn = ConnexionDB::get_connexion();

            $sql = "INSERT INTO ". $this->table ." (";
            foreach ($this->fillable as $col) {
                $sql .= $col . ", ";
            }

            $sql .= self::CREATED_AT.", ".self::UPDATED_AT;
            $sql .= ") VALUES ( ";

            foreach ($this->fillable as $col) {
                $sql .= "'". $this->{$col} . "', ";
            }

            $timestamp = date('Y-m-d H:i:s');
            $sql .= "'".$timestamp."', '".$timestamp."'";

            $sql .= " );";

            $conn->exec($sql);

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            echo "Can't insert data : " . $e->getMessage();
        }
    }

    /**
     *
     * Delete this instance from the database.
     *
     * @return mixed
     */
    public function delete() {

    }

    /**
     *
     * Update this instance to the database.
     *
     * @return mixed
     */
    public function update() {

    }

    /**
     *
     */
    private function fetchTableStructure() {
        $conn = ConnexionDB::get_connexion();
        // run an empty query
        $sql = "DESCRIBE ". $this->table ." ;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $item) {
            $this->{$item['Field']} = '';
            array_push($this->attributes, $item['Field']);
        }
        ConnexionDB::close_connexion();
    }

}
