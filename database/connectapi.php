<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connectapi
 *
 * @author pieter
 */
class Connectapi {

    private $baseurl = 'http://services.wine.com/api/beta2/service.svc/json/catalog?apikey=91cdba58f7d07785acd564039026e83e';

    public function searchwine($searchword) {
        $app_info = file_get_contents($this->baseurl.'&search='.  urlencode($searchword));
        $app_info = json_decode($app_info, true);
        //print_r($app_info);
        return $app_info;
    }

}

?>
