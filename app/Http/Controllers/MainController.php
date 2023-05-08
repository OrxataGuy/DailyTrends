<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\MarcaFeed as Marca;
use App\Models\ElMundoFeed as ElMundo;
use App\Models\ElPaisFeed as ElPais;
use App\Models\LevanteFeed as Levante;
use App\Models\AsFeed as ASCOM;
use App\Models\ValenciaPlazaFeed as ValenciaPlaza;

class MainController extends Controller
{
    protected $scrapper;

    public function __construct(Client $scrapper)
    {
        $this->scrapper = $scrapper;
    }

    public function index() {

    }
}
