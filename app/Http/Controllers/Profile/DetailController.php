<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Step;
use App\Profile;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
  // 画面表示
    public function view($id) {
      // GETパラメータが数字かどうかチェックする
      if(!ctype_digit($id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }

      // プロフィール情報取得
      $profile = Profile::where('id', $id)->first();
      // ユーザーが登録したSTEPを取得
      $steps = DB::table('steps')
                  ->select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id')
                  ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                  ->where('user_id', $id)
                  ->paginate(6);

      return view('Profile/detail', ['profile' => $profile, 'steps' => $steps]);
    }
}
