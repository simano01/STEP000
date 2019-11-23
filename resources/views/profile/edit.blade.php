@extends('layouts.app')

@section('content')
  <div class="l-main__profEdit">
    <form class="p-form" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h2 class="p-form__title mb5">プロフィール編集</h2>

      <div class="js-count-container">
        <label for="">名前</label>
        <input type="text" name="name" class="p-form__input @error('name') p-form__is-invalid @enderror js-count-text50 js-count-name" required value="@if($profile){{ $profile->name }} @else 名無しさん @endif">
        <div class="counter-container"><span class="js-show-count-text">0</span>/50</div>

        <span class="p-form__invalid-feedback p-form__is-invalid" role="alert">
            <strong class="error-name">@error('name'){{ $message }}@enderror</strong>
        </span>
      </div>

      <label for="">アイコン画像</label>
      <div class="area-drop js-imgDrop">
        <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
        <input id="image" type="file" name="image" class="js-input-file input-file p-form__input @error('image') p-form__is-invalid @enderror" value="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif">
        <img src="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif" alt="アイコン画像" class="prev-img js-prev-img" @if (!($profile)) style="display: none;" @endif>
        <span class="img_drag">ドラッグ<br>＆<br>ドロップ</span>
      </div>
      @error('image')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="js-count-container">
        <label for="">自己紹介文</label>
        <textarea name="introduction" class="p-form__input js-count-introduction js-count-text255 @error('introduction') p-form__is-invalid @enderror" rows="8" cols="80">@if($profile){{ $profile->introduction }} @else プロフィールはまだありません @endif</textarea>
        <div class="counter-container"><span class="js-show-count-text">0</span>/255</div>

        <span class="p-form__invalid-feedback p-form__is-invalid" role="alert">
            <strong class="error-introduction">@error('introduction'){{ $message }}@enderror</strong>
        </span>

      </div>

      <label for="">メールアドレス</label>
      <input type="text" name="email" class="p-form__input @error('email') p-form__is-invalid @enderror required" value="@if($user){{ $user->email }}@endif {{ old('eamil')}}">
      @error('email')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <input type="submit" name="submit" class="c-btn js-submit-btn" value="変更する">
    </form>
  </div>
@endsection
