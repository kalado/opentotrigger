<?php
class Status extends AppModel{
    var $name = "Status";
    var $useTable = "status";
    
    var $hasMany = array(
        'Series' => array(
            'className' => 'Serie',
        ),
        'Animes' => array(
            'className' => 'Anime',
        ),
    );
    
}
?>