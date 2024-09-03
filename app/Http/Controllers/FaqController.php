<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $AllfaqQuestions = FaqQuestion::all();
        // $faqQuestions = FaqQuestion::all()->chunk(ceil($AllfaqQuestions->count() / 2));
        $faqQuestions = FaqQuestion::all();
        return view('site.faqQuestions.index', compact('faqQuestions'));
    }
}
