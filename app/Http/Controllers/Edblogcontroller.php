<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\ArtCats;
use App\Reaction;

class Edblogcontroller extends Controller
{
    public function getArticles() {
      //$articles = array("artikel1","artikel2","artikel3","artikel4");
      $articles = Article::orderBy('Datum', 'DESC')->get(); //Article::all();
      //$categories = Category::all();
      $artcategories =  Category::select('*')
       ->join('ArtCats', 'ArtCats.catnr', '=', 'categorieen.catid')
       //->where('countries.country_name', $country)
       ->get();

      $reactions =  Reaction::all();
      $categories = Category::all();
      //return $articles;
      return view('blogpages.edblog')-> with("articles", $articles)
                                     -> with("artcategories", $artcategories)
                                     -> with("categories", $categories)
                                     -> with("reactions", $reactions);

    }


    //***********************************************************************************
    public function getCatArticles($catid) {
       $articles = Article::select('*')
        ->join('ArtCats', 'Artikelen.Artnr', '=', 'ArtCats.artikelnr')
        ->where('ArtCats.catnr', $catid)
        ->get();

        $artcategories =  Category::select('*')
         ->join('ArtCats', 'ArtCats.catnr', '=', 'categorieen.catid')
         ->get();

        $reactions =  Reaction::all();
        $categories = Category::all();

        return view('blogpages.blogarticles',compact('articles'))
                        -> with("artcategories", $artcategories)
                        -> with("categories", $categories)
                        -> with("reactions", $reactions);
    }

    //***********************************************************************************
    public function getZoekArticles($zoekfilter) {
       //$articles = Article::select('*')
        //->join('ArtCats', 'Artikelen.Artnr', '=', 'ArtCats.artikelnr')
        //->where('ArtCats.catnr', $catid)
      //  ->get();

        $articles = Article::orderBy('Datum', 'DESC')
        ->where('Artikelen.Artikelinhoud','LIKE', '%'.$zoekfilter.'%' )
        ->orwhere('Artikelen.Artikelnaam','LIKE', '%'.$zoekfilter.'%')
        ->get(); //Article::all();

        $artcategories =  Category::select('*')
         ->join('ArtCats', 'ArtCats.catnr', '=', 'categorieen.catid')
         ->get();

        $reactions =  Reaction::all();
        $categories = Category::all();

        return view('blogpages.blogarticles',compact('articles'))
                        -> with("artcategories", $artcategories)
                        -> with("categories", $categories)
                        -> with("reactions", $reactions);

    }

    //***********************************************************************************
    public function getAllArticles() {
      $articles = Article::orderBy('Datum', 'DESC')->get(); //Article::all();
      $artcategories =  Category::select('*')
       ->join('ArtCats', 'ArtCats.catnr', '=', 'categorieen.catid')
       ->get();
      $reactions =  Reaction::all();
      $categories = Category::all();

      return view('blogpages.blogarticles',compact('articles'))
                        -> with("artcategories", $artcategories)
                        -> with("categories", $categories)
                        -> with("reactions", $reactions);

    }

    //***********************************************************************************
    public function storereaction() {
      $reaction = new Reaction;

      $reaction -> artikelid = request('artnr');
      $reaction -> reactie = request('reaction');

      $reaction-> save();


      return redirect("/edblog");

    }
}
