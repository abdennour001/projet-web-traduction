<?php

require_once 'database/ConnexionDB.php';
require_once 'HasRelationShips.php';
require_once 'InheritanceRelationShips.php';

abstract class Model {

    use HasRelationShips;
    use InheritanceRelationShips;

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
     * @param string $order_by
     * @return array
     */
    public static function all($order_by = 'ASC') {
        $resultArray = [];
        $self = new static;
        try {
            $conn = ConnexionDB::get_connexion();

            $stmt = $conn->prepare("SELECT * FROM " . $self->table . " ORDER BY created_at ". $order_by);
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
     *
     * @return bool
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
            die("Can't insert data : " . $e->getMessage());
        }
        return true;
    }

    /**
     *
     * Delete this instance from the database.
     *
     * @return bool
     */
    public function delete() {
        try {
            $conn = ConnexionDB::get_connexion();

            $sql = "DELETE FROM ". $this->table ." WHERE " .
                $this->primaryKey . " = " . $this->{$this->primaryKey};

            $conn->exec($sql);

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {

        }
        return true;
    }

    /**
     *
     * Update this instance to the database.
     *
     * @return bool
     */
    public function update() {
        try {
            $conn = ConnexionDB::get_connexion();

            $sql = "UPDATE ". $this->table ." SET ";
            foreach ($this->fillable as $col) {
                $sql .= $col . " = '" . $this->{$col} . "', ";
            }
            $timestamp = date('Y-m-d H:i:s');
            $sql .= self::UPDATED_AT . " = '" . $timestamp . "'";
            $sql .= " WHERE " . $this->primaryKey . " = " . $this->{$this->primaryKey};
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            die("Can't update data : " . $e->getMessage());
        }
        return true;
    }

    /**
     * Associate the model $model to this model.
     *
     * @param $model
     */
    public function associate($model) {
        $model->{$this->primaryKey} = $this->{$this->primaryKey};
        if (isset($this->{$model->primaryKey})) {
            $this->{$model->primaryKey} = $model->{$model->primaryKey};
        }
    }

    /**
     * @param $model
     */
    public function attach($model) {
        $class = get_class($this) . get_class($model);
        require_once 'sideline/' . $class . '.php';
        $hidden = new $class;
        $hidden->{$this->primaryKey} = $this->{$this->primaryKey};
        $hidden->{$model->primaryKey} = $model->{$model->primaryKey};
        $res = $class::where([
            $this->primaryKey => $this->{$this->primaryKey},
            'AND',
            $model->primaryKey => $model->{$model->primaryKey}
        ]);
        if ( $res == null) {
            $hidden->save();
        } else {
            echo "Can't attach, relation already exist.";
        }
    }

    /**
     * Paginate the query.
     *
     * @param $no_items_per_page
     * @return mixed
     */
    public static function paginate($no_items_per_page) {
        $resultArray = [];
        $self = new static;

        if (isset($_GET['page_no'])) {
            $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
        }

        $offset = ($page_no-1) * $no_items_per_page;

        try {
            $conn = ConnexionDB::get_connexion();

            $stmt_count = $conn->prepare("SELECT count(*) FROM " . $self->table);
            $stmt_count->execute();
            $total_rows = $stmt_count->fetch()[0];

            $total_pages = ceil($total_rows / $no_items_per_page);

            $stmt = $conn->prepare("SELECT * FROM " . $self->table . " ORDER BY updated_at DESC LIMIT $offset, $no_items_per_page");
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
        return ["result" => $resultArray, "page_no" => $page_no, "total_pages" => $total_pages];
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
