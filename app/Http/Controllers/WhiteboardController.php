<?php

namespace App\Http\Controllers;

use Aws\Chime\ChimeClient;
use Aws\Chime\Exception\ChimeException;
use Aws\Credentials\Credentials;
use Illuminate\Http\Request;

/**
 *
 */
class WhiteboardController
{
    protected $credentials;
    protected $chime;


    public function __construct() {
        $credentials = new Credentials(
            env('AWS_ACCESS_KEY_ID'),
            env('AWS_SECRET_ACCESS_KEY'),
        );

        $this->chime = new ChimeClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials,
        ]);
    }


    public function index() {
        return view('wb');
    }
}
