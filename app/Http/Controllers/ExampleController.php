<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class ExampleController extends Controller
{
    public function showphoto() {
        $client = new Client();
        $ablums = $client->request('GET', 'https://jsonplaceholder.typicode.com/albums');
        $photos = $client->request('GET', 'https://jsonplaceholder.typicode.com/photos');
        $ablums = json_decode($ablums->getBody()->getContents(), true);
        $photos = json_decode($photos->getBody()->getContents(), true);
        $files = [];
        foreach ($photos as $photo){
            $index = array_search($photo['albumId'], array_column($ablums, 'id'));
            $files[$ablums[$index]['title']][] = $photo;
        }
        return view('welcome', ['files' => $files]);
    }
}
