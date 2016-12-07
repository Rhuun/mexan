<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XmlParser;
use App\Article;
use App\Additional_attribut;
use DB;

class MexanController extends Controller
{
  /**
   * Start the import
   */
    public function import(){
      DB::table('additional_attributes')->delete();
      DB::table('articles')->delete();

      $filePath = base_path().'\app\importData\import.xml';

      $xml = XmlParser::load($filePath);
      $articles = $xml->getContent();

      foreach($articles as $article){
        $newArticle = new Article;
        $newArticle->id = $article->id;
        $newArticle->name = $article->name;
        $newArticle->categories = $article->categories;
        $newArticle->price = $article->price;
        $newArticle->save();
        if(isset($article->additional_attributes) && !empty($article->additional_attributes)){
          foreach($article->additional_attributes as $additional_attribut_item){
            foreach($additional_attribut_item as $item){
              $newAdditionalAttribut = new Additional_attribut;
              $newAdditionalAttribut->article_id = $article->id;
              $newAdditionalAttribut->attribute_code = $item->attribute_code;
              $newAdditionalAttribut->value = $item->value;
              $newAdditionalAttribut->save();
            }
          }
        }
      }
    }

    public function index(){
      $articles = Article::all();
      $arrData = [];
      foreach($articles as $article){
        $additionalAttributes = Additional_attribut::where('article_id', '=', $article->id)->get();
        $arrAdditionalAttributes = [];
        foreach($additionalAttributes as $item){
          $arrAdditionalAttributes[] = ['attribute_code' => $item->attribute_code, 'value' => $item->value];
        }

        $arrData[] = ['name' => $article->name, 'price' => $article ->price, 'arrAdditionalAttributes' => $arrAdditionalAttributes];
      }
      return view('/Mexan/index', ['arrData' => $arrData]);
    }
}
