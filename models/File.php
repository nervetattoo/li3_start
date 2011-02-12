<?php

namespace app\models;

class File extends \lithium\data\Model {

    protected $_meta = array('source' => 'fs.files');
    protected $_schema = array(
        '_id' => array('type' => 'id'),
        'title' => array('type' => 'string'), 
        'created' => array('type' => 'date'), 
        'slug' => array('type' => 'string'), 
    );


    /**
     * Override _init to ensure MongoDb indexes
     */
    public static function __init()
    {
        parent::__init();

        static::finder('slug', function($self, $params, $chain) {
            $params['options']['conditions'] = array(
                'slug' => $params['options']['conditions']['_id']
            );
            $data = $chain->next($self, $params, $chain);
            $data = is_object($data) ? $data->rewind() : $data;
            return $data ?: null;
        });

        $collection = static::connection()->connection->{static::meta('source')};
        $collection->ensureIndex(array('title' => 1));
    }
}
