<?php

include_once 'includes/angel_items.class.php';

//class angel_items_cntrl extends angelItems {
class angel_items_cntrl {

    private $angel_type;
    private $data_type;
    private $ai_obj;
    var $sponsor_id=null;

    function __construct($angel_type=null,$data_type=null){
        $this->ai_obj = new angelItems();
//        parent::__construct();
        $this->setAngelType($angel_type);
        $this->setDataType($data_type);

    }


    function getAngelItemsArr(){

        if(!is_null($this->sponsor_id) && $this->angel_type == 'sponsored') {
            $angel_items_arr = $this->ai_obj->getSponsordItems();
//            $angel_items_arr = $this->getSponsordItems();
        }else {
            $angel_items_arr = $this->ai_obj->getAvailableItems();
//            $angel_items_arr = $this->getAvailableItems();
        }

        if ($this->data_type == 'json') {
            dspJson($angel_items_arr);
        }else {
            return $angel_items_arr;
        }
    }

    function dspJson($arr){
        echo json_encode($arr);
    }

    function getAngelType(){
        return $this->angel_type;
    }
    function setAngelType($val){
        $this->angel_type=$val;
    }

    function getDataType(){
        return $this->data_type;
    }
    function setDataType($val){
        $this->data_type=$val;
    }

    function getSponsorId(){
        $this->sposnor_id = $this->ai_obj->getSposorId();
        return $this->sposnor_id;
    }
    function setSponsorId($val){
        $this->sponsor_id=$val;
        $this->ai_obj->setSponsorId($val);
    }
}
?>