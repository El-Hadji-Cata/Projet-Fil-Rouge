<?php

class MessageCtrl
{
    public $alertError = null;

    public $alertSuccess = null;

    public $missionModel;

    public function __construct($db)
    {
        $this->missionModel = new MissionModel($db);
    }
    
}
?>