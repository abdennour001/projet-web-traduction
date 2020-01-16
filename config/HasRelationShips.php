<?php


trait HasRelationShips {


    /**
     * Define a one-to-one relationship.
     *
     * @param $related
     * @param null $foreignKey
     * @param null $localKey
     * @return mixed
     */
    public function hasOne($related, $foreignKey = null, $localKey = null) {
        return $related::where([
            $foreignKey => $this->{$this->primaryKey}
        ])[0] ?: null;
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @param $related
     * @param null $foreignKey
     * @param null $ownerKey
     * @param null $relation
     * @return mixed
     */
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null) {
        return $related::where([
            $foreignKey ?: $this->primaryKey => $this->{$this->primaryKey}
        ])[0] ?: null;
    }

    /**
     * Define a one-to-many relationship.
     *
     * @param  string  $related
     * @param  string  $foreignKey
     * @param  string  $localKey
     * @return mixed
     */
    public function hasMany($related, $foreignKey = null, $localKey = null) {
        return $related::where([
            $foreignKey => $this->{$this->primaryKey}
        ]) ?: null;
    }

    /**
     * Define a many-to-many relationship.
     *
     * @param  string  $related
     * @param  string  $table
     * @param  string  $foreignPivotKey
     * @param  string  $relatedPivotKey
     * @param  string  $parentKey
     * @param  string  $relatedKey
     * @param  string  $relation
     * @return mixed
     */
    public function belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
                                  $parentKey = null, $relatedKey = null, $relation = null) {

        $resultArray = [];
        try {
            $conn = ConnexionDB::get_connexion();

            $query = "SELECT
                        ". strtolower($related) .".*
                    FROM
                        ". strtolower($related) ."
                        JOIN ". $table ." ON ". strtolower($related) .".". $foreignPivotKey ." = ". $table .".". $foreignPivotKey ."
                    WHERE
                        ". $table .".". $this->primaryKey ." = '". $this->{$this->primaryKey} . "'";
            echo $query . "\n\n";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $_resultArray = $stmt->fetchAll();
            foreach ($_resultArray as $row) {
                $model = new $related;
                foreach ($row as $k => $v) {
                    $model->{$k} = $v;
                }
                array_push($resultArray, $model);
            }

            ConnexionDB::close_connexion();
        } catch (PDOException $e) {
            die("\nCan't get data : " . $e->getMessage());
        }
        return $resultArray;

    }

}
