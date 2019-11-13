<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use App\Charenge;
use App\Profile;
use App\ChildStep;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MypageController extends Controller
{
  // 画面表示
  public function view() {
    // ログイン者のユーザーID
    $user_id = Auth::id();
    // ユーザーが登録したSTEPとチャレンジ登録したSTEPを取得
    $steps = Step::where('user_id', $user_id)
                ->select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id')
                ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                ->paginate(6);
    $charenges = Step::select('steps.title', 'steps.id', 'steps.overview', 'categorys.name', 'categorys.id as category_id', 'charenge.id as charenge_id', 'charenge.step_id')
                ->leftJoin('categorys', 'steps.category_id', '=', 'categorys.id')
                ->join('charenge', 'steps.id', '=', 'charenge.step_id')
                ->where('charenge.user_id', $user_id)
                ->paginate(6);
    // チャレンジ登録したSTEPがあれば、その子STEPとクリア情報を取得する
    if($charenges) {
      $charenge_c_steps = ChildStep::join('charenge', 'step_detail.step_id', 'charenge.step_id')
                                    ->where('charenge.user_id', $user_id)
                                    ->get();
      $clear_c_steps = ChildStep::join('charenge', 'step_detail.step_id', 'charenge.step_id')
                                    ->where('charenge.user_id', $user_id)
                                    ->join('step_detail_clear', 'step_detail.id', 'step_detail_clear.step_detail_id')
                                    ->where('step_detail_clear.user_id', $user_id)
                                    ->get();
    }
    // ユーザーのプロフィールを取得
    $profile = Profile::where('user_id', $user_id)->first();

    return view('mypage', ['steps' => $steps, 'charenges' => $charenges,
     'profile' => $profile, 'user_id' => $user_id, 'charenge_c_steps' => $charenge_c_steps,
     'clear_c_steps' => $clear_c_steps]);
  }
}
