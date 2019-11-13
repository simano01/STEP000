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

class RegisterController extends Controller
{
    // 画面表示
    public function view() {
      // 全てのカテゴリを取得
      $categorys = Category::all();
      // 全ての達成時間を取得
      $achievement_times = Achievement_time::all();

      return view('step.register', ['categorys' => $categorys, 'achievement_times' => $achievement_times]);
    }

    // STEP登録
    public function create(StepRegister $request) {
      // STEP登録
      $step = new Step;
      Auth::user()->steps()->save($step->fill($request->all()));
      // 子STEP登録
      $i = 0;
      foreach($request->num as $val) {
        $child_step = new ChildStep;
        $child_step->title = $request->child_title[$i];
        $child_step->description = $request->description[$i];
        $child_step->step_id = $step->id;
        $child_step->num = $i;
        Auth::user()->child_steps()->save($child_step);
        $i++;
      }

      return redirect('/mypage')->with('flash_message', __('登録しました！'));
    }
}
