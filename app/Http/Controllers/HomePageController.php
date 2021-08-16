<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\HomePage;
use App\Models\Produtos;
use App\Events\Chat\RealtimeMessage;
use Illuminate\Support\Facades\Storage; 

class HomePageController extends Controller
{
    private $homePage;

    public function __construct(HomePage $homePage)
    {
        $this->homePage = $homePage;
    }
    public function index()
    {
        $dir_img = './public/homepage/LogosCarrosel';
        $images = Storage::files($dir_img);
        $last_products = Produtos::orderBy('id', 'asc')->take(5)->get();
        
        return Inertia::render('HomePage/homeComponent',[
            'images' => $images,
            'last_products' => $last_products,
        ]);
    }
}
