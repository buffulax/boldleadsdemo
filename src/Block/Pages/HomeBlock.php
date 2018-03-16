<?php

namespace Example\Block\Pages;

/**
 * Class HomeBlock
 * @package Example\Block\Pages
 */
class HomeBlock {

    /** @var string $title */
    private $title = 'Contact Us';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

//    public function getBooks($search = 'dog cat')
//    {
//        $key = 'AIzaSyCmJRsR54CXaHVkZamxFAmSo329m-W0Bn0';
//
//        //GET https://www.googleapis.com/books/v1/volumes?q=flowers+inauthor:keyes&key=yourAPIKey
//
//        $url = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($search)."&key=".$key;
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_VERBOSE, 0);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//        curl_setopt($ch, CURLOPT_URL, $url);
//        //curl_setopt($ch, CURLOPT_POST, true);
//        $response = curl_exec($ch);
//        curl_close($ch);
//
//
//
//        return json_decode($response, true);
//    }
}