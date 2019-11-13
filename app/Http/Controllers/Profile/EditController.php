<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use App\Step;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
  // 画面表示
    public function view($id) {
      // GETパラメータが数字か、自分のuser_idと一致するかチェックする
      if(!ctype_digit($id)) {
        return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
      }else{
        $user_id = Auth::id();
        if($id != $user_id) {
          return redirect('/mypage')->with('flash_message', '不正なアクセスが行われました。');
        }
      }

      // プロフィール取得
      $profile = Profile::where('user_id', $id)->first();
      // ログイン者のユーザーID取得
      $user = Auth::user($id);

      return view('profile/edit', ['profile' => $profile, 'user' => $user]);
    }

    // プロフィールの更新
    public function update(ProfileRequest $request) {
      // ログイン者のユーザーIDを取得
      $user_id = Auth::id();
      // プロフィール情報取得
      $profile = Profile::where('user_id', $user_id)->first();
      if(!($profile)) { // プロフィールがDBになかったら新規登録

        if(!($request->image)) {
          $image = '';
        } else {
          // 画像アップロード処理
          $image = $request->file('image');
          // 画像はS3に保存し、そのURLをDBに保存
          $path = Storage::disk('s3')->putFile('/', $image, 'public');
          $image = Storage::disk('s3')->url($path);
        }

        $profile = new Profile;
        $profile->insert([
          'name' => $request->name,
          'image' => $image,
          'introduction' => $request->introduction,
          'user_id' => $user_id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      } else { // プロフィールがDBにあったら更新

        if(!($request->image)) {
          $image = $profile->image;
        } else {
          // 画像アップロード処理
          $image = $request->file('image');
          $path = Storage::disk('s3')->putFile('/', $image, 'public');
          $image = Storage::disk('s3')->url($path);
        }

        $profile->update([
          'name' => $request->name,
          'image' => $image,
          'introduction' => $request->introduction,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      }

     User::where('id', $user_id)->update([
       'email' => $request->email
     ]);

    return redirect('/mypage')->with('flash_message', 'プロフィールを編集しました！');

  }
}
