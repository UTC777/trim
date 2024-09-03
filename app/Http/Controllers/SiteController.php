<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Slider;

class SiteController extends Controller
{
    public function index()
    {
        $sliders = Slider::published()->where('location',1)->get();

        return view('site.static.home.index', compact('sliders'));
    }

    public function contact()
    {
        return view('site.static.contact');
    }
}
