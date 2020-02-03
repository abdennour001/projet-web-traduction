<?php


class Notification extends Model {

    protected $table = 'notification';
    protected $primaryKey = 'id_notification';

    protected $fillable = ['id_user', 'title', 'description', 'vu'];

    /**
     * Get the user of this notification.
     *
     * @return mixed
     */
    public function user() {
        return $this->belongsTo('User', 'id_user');
    }

}
