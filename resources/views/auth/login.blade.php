@extends('layouts.app')

@section('content')
<div class="l-main__login">

  <form class="p-form" action="{{ route('login') }}" method="post">
    @csrf

    <h2 class="p-form__title">ログイン</h2>

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
    <div class="p-form__remember">
      <input type="checkbox" name="remember" class="p-form__remember__checkbox" {{ old('remember') ? 'checked' : '' }}>
      <p>ログイン保持する</p>
    </div>
    <input type="submit" name="submit" class="c-btn" value="ログイン">
    @if (Route::has('password.request'))
        <a class="p-form__pass-remind" href="{{ route('password.request') }}">
          &lt; パスワードを忘れた方はこちら
        </a>
    @endif
  </form>

</div>
@endsection
