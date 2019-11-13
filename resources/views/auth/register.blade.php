@extends('layouts.app')

@section('content')
  <div class="l-main__register">

    <form class="p-form" action="{{ route('register') }}" method="post">
      @csrf

      <h2 class="p-form__title">ユーザー登録</h2>

      <input type="text" name="email" class="p-form__input @error('email') p-form__is-invalid @enderror" required value="{{ old('email') }}" placeholder="メールアドレスを入力">
      @error('email')
          <span class="p-form__invalid-feedback" role="alert">
              {{ $message }}
          </span>
      @enderror
      <input type="password" name="password" class="p-form__input @error('password') p-form__is-invalid @enderror" required placeholder="パスワードを入力（8文字以上）">
      @error('password')
          <span class="p-form__invalid-feedback" role="alert">
              {{ $message }}
          </span>
      @enderror
      <input type="password" name="re_password" class="p-form__input @error('re_password') p-form__is-invalid @enderror" required placeholder="もう一度パスワードを入力">
      @error('re_password')
          <span class="p-form__invalid-feedback" role="alert">
              {{ $message }}
          </span>
      @enderror
      <input type="submit" name="submit" class="c-btn" value="登録する">
    </form>

  </div>
@endsection
