<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/8/2016
 * Time: 9:29 AM
 */

namespace App\Services;

use Dusterio\LinkPreview\Client;

 class VenueService
{


     private static $instance = null;

     public function __construct(){


     }

     public static function  instance(){
         if(self::$instance == null) {
             self::$instance = new UserService();
         }
         return self::$instance;
     }

     public function fetchPreview($url){
         $previewClient = new Client($url);

// Get previews from all available parsers
//         $previews = $previewClient->getPreviews();

// Get a preview from specific parser
         $preview = $previewClient->getPreview('general');

// Convert output to array
         $preview = $preview->toArray();

         return $preview;
     }

}