<?php


trait InheritanceRelationShips {


    /**
     * Get the Father model of this slave model.
     *
     * @param string $related
     * @return mixed
     */
    public function belongsToMaster($related) {
        return $related::find($this->{$this->primaryKey});
    }


    /**
     * Get the slave model of this father model.
     *
     * @param string $related
     * @return mixed
     */
    public function hasSlave($related) {
        return $related::find($this->{$this->primaryKey});
    }
}
