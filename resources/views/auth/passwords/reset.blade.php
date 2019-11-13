@extends('layouts.app')

@section('content')
<div class="l-main__pass-reset">

  <form class="p-form" action="{{ route('password.update') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <h2 class="p-form__title">パスワード変更</h2>

    <input type="text" name="email" class="p-form__input @error('email') p-form__is-invalid @enderror" value="{{ old('email') }}" required placeholder="メールアドレスを入力">
    @error('email')
        <span class="p-form__invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
    <input type="password" name="password" class="p-form__input @error('password') p-form__is-invalid @enderror" required placeholder="新しいパスワードを入力">
    @error('password')
        <span class="p-form__invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
    <input type="password" name="password_confirmation" class="p-form__input @error('password_confirmation') p-form__is-invalid @enderror" required placeholder="もう一度パスワードを入力">
    @error('password_confirmation')
        <span class="p-form__invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror

    <input type="submit" name="submit" class="c-btn" value="変更する">
  </form>

</div>
@endsection
