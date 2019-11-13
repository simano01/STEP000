<?php

namespace App\Http\Controllers\Step;

use Illuminate\Http\Request;
use App\Http\Requests\StepSearch;
use App\Http\Controllers\Controller;
use App\Step;
use App\Category;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
  // 画面表示
    public function view() {
      // 全てのカテゴリ取得
      $categorys = Category::all();
      // 全てのSTEPをカテゴリに紐づけて取得
      $steps = DB::table('steps')
                  ->select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id')
                  ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                  ->paginate(10);
      return view('step.list', ['steps' => $steps, 'categorys' => $categorys]);
    }

    // カテゴリー検索
    public function searchCategory(Request $request) {
      $s_category = $request->category_id;
      $categorys = Category::all();
      $steps = DB::table('steps')
                  ->select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id')
                  ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                  ->where('category_id', $s_category)
                  ->paginate(10);
      return view('step.list', ['steps' => $steps, 'categorys' => $categorys]);
    }

    // ワード検索
    public function searchWord(StepSearch $request) {
      $s_word = $request->keyword;
      $categorys = Category::all();
      $steps = DB::table('steps')
                  ->select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id')
                  ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                  ->where('steps.title', 'like', '%'.$s_word.'%')
                  ->orWhere('steps.overview', 'like', '%'.$s_word.'%')
                  ->paginate(10);
      return view('step.list', ['steps' => $steps, 'categorys' => $categorys]);
    }
}
