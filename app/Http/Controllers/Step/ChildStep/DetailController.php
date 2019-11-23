<?php

namespace App\Http\Controllers\Step\ChildStep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Step;
use App\ChildStep;
use App\Clear;
use App\Charenge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DetailController extends Controller
{
    // 画面表示
    public function view($id, $child_step_id) {
      // GETパラメータが数字かどうかチェックする
      if(!ctype_digit($id) || !ctype_digit($child_step_id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }

      // ログイン者のユーザーID取得
      $user_id = Auth::id();
      // $idと一致するSTEP取得
      $step = Step::find($id);
      if($step) {
        // STEPに紐づく子STEPを取得
        $child_step = ChildStep::where('step_id', $id)->where('id', $child_step_id)->first();
        if($child_step) {
          // STEPに紐づくカテゴリ取得
          $category = $step->category;
          // STEPのチャレンジ情報を取得
          $charenge = Charenge::where('step_id', $id)->where('user_id', $user_id)->first();
          // 子STEPのクリア情報を取得
          $clear = Clear::where('step_detail_id', $child_step_id)->where('user_id', $user_id)->first();
          // １つ前の子STEPのクリア情報を取得
          if($child_step->num === 0) {
            $before_clear = 1;
          }else{
            $child_step->id -= 1;
            $before_clear = Clear::where('step_detail_id', $child_step_id)->where('user_id', $user_id)->first();
          }

          return view('step.childStep.detail', [
            'step' => $step, 'child_step' => $child_step, 'user_id' => $user_id,
             'category' => $category, 'clear' => $clear, 'charenge' => $charenge,
             'before_clear' => $before_clear
           ]);
        }else { // DBに登録してない子STEPのIDで画面表示の要求があった場合、マイページへ飛ばす
          return redirect('/mypage')->with('flash_message', '該当するSTEPがありませんでした。');
        }
      }else{ // DBに登録してないSTEPのIDで画面表示の要求があった場合、マイページへ飛ばす
        return redirect('/mypage')->with('flash_message', '該当するSTEPがありませんでした。');
      }
    }

    // 子STEPのクリア登録
    public function clear($id, $child_step_id) {
      // GETパラメータが数字かどうかチェックする
      if(!ctype_digit($id) && !ctype_digit($child_step_id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }

      // ログイン者のユーザーIDを取得
      $user_id = Auth::id();
      // クリア登録
      $clear = new Clear;
      $clear->step_detail_id = $child_step_id;
      $clear->user_id = $user_id;
      Auth::user()->clears()->save($clear);

      return redirect('step/'.$id)->with('flash_message', 'お疲れ様でした！');
    }
}
