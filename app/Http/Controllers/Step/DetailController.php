<?php

namespace App\Http\Controllers\Step;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Step;
use App\ChildStep;
use App\Charenge;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DetailController extends Controller
{
    // 画面表示
    public function view($id) {
      // GETパラメータが数字かチェック
      if(!ctype_digit($id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }

      // ログイン者のユーザーID取得
      $user_id = Auth::id();
      // $idと一致するSTEP取得
      $step = Step::find($id);

      if($step) {
        // STEPに紐づくカテゴリを取得
        $category = $step->category;
        // STEPに紐づく達成時間を取得
        $achivement_time = $step->achievement_time;
        // STEPのチャレンジ情報取得
        $charenge = Charenge::where('step_id', $id)->where('user_id', $user_id)->first();
        // STEPに紐づく子STEP取得
        $child_steps = ChildStep::where('step_id', $id)
                                  ->select('step_detail.id', 'step_detail.num', 'step_detail.title')
                                  ->get();
        // STEPのクリア数取得
        $clears = ChildStep::where('step_id', $id)
                                  ->where('step_detail_clear.user_id', $user_id)
                                  ->select('step_detail_clear.id', 'step_detail_clear.user_id', 'step_detail_clear.step_detail_id')
                                  ->leftJoin('step_detail_clear', 'step_detail.id', '=', 'step_detail_clear.step_detail_id')
                                  ->count();

        // STEPを登録した人のプロフィールを取得
        $profile = Profile::where('user_id', $step->user_id)->first();

        return view('step.detail', ['step' => $step, 'child_steps' => $child_steps,
        'user_id' => $user_id, 'category' => $category, 'charenge' => $charenge,
        'profile' => $profile, 'achivement_time' => $achivement_time, 'clears' => $clears]);
      }else{ // DBに登録してないSTEPのIDで画面表示の要求があった場合、マイページへ飛ばす
        return redirect('/mypage')->with('flash_message', '該当するSTEPがありませんでした。');
      }
    }

    // チャレンジ登録
    public function charenge($id) {
      $user_id = Auth::id();
      $charenge = new Charenge;
      $charenge->step_id = $id;
      $charenge->user_id = $user_id;
      Auth::user()->charenges()->save($charenge);

      return redirect('/mypage')->with('flash_message', 'チャレンジ登録しました！');
    }
}
