<?php

namespace App\Http\Controllers\Step;

use Illuminate\Http\Request;
use App\Http\Requests\StepRegister;
use App\Http\Controllers\Controller;
use App\Category;
use App\Achievement_time;
use App\Step;
use App\ChildStep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EditController extends Controller
{
    // 画面表示
    public function view($id) {
      // GETパラメータが数字か、自分のuser_idと一致するかチェックする
      if(!ctype_digit($id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }else{
        $user_id = Auth::id();
        $step = Step::find($id);
        if($step) {
          if($step->user_id !== $user_id) {
            return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
          }
        }else{
          return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
        }
      }
      
      // 全てのカテゴリを取得
      $categorys = Category::all();
      // 全ての達成時間を取得
      $achievement_times = Achievement_time::all();
      // $idと一致するSTEPを取得
      $step = Step::find($id);
      // STEPに紐づく子STEPを取得
      $child_steps = ChildStep::where('step_id', $id)->get();

      return view('step.edit', [
        'step' => $step, 'categorys' => $categorys, 'achievement_times' => $achievement_times, 'child_steps' => $child_steps
      ]);
    }

    // STEPを編集する
    public function update(StepRegister $request, $id) {
      // $idと一致するSTEPを取得
      $step = Step::find($id);
      // STEPを変更
      Auth::user()->steps()->save($step->fill($request->all()));
      // 子STEPを変更
      $i = 0;
      foreach($request->num as $val) {
        ChildStep::where('step_id', $id)->where('num', $i)
          ->update([
            'title' => $request->child_title[$i],
            'description' => $request->description[$i],
            'step_id' => $step->id,
            'num' => $i,
          ]);
          if(!(ChildStep::where('step_id', $id)->where('num', $i))->first()) { // DBにデータがなければ新規登録
              $child_step = new ChildStep;
              $child_step->title = $request->child_title[$i];
              $child_step->description = $request->description[$i];
              $child_step->step_id = $step->id;
              $child_step->num = $i;
              Auth::user()->child_steps()->save($child_step);
          }
        $i++;
      }
      // $idと一致する子STEPの件数を取得
      $child_step_count = ChildStep::where('step_id', $id)->count();
      // $requestの子STEP数を数える
      $re_child_step = count($request->num);
      // DBにはデータがあるが、$requestにデータがない子STEPは削除する
      for ($i = 0; $i < $child_step_count; $i++) {
        if ($i >= $re_child_step) {
          ChildStep::where('step_id', $id)->where('num', $i)->delete();
        }
      }

      return redirect('/mypage')->with('flash_message', '変更しました！');
    }

    // STEPを削除する
    public function delete(Request $request, $id) {
      // 子STEPを削除
      ChildStep::where('step_id', $id)->delete();
      // STEPを削除
      Step::find($id)->delete();

      return redirect('/mypage')->with('flash_message', '削除しました！');
    }
}
