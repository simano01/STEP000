@extends('layouts.app')

@section('content')
<div class="l-main__pass-email">

  @if (session('status'))
      <div class="alert alert-success js-show-msg" role="alert" style="display: none;">
          {{ session('status') }}
      </div>
  @endif

  <form class="p-form" action="{{ route('password.email') }}" method="post">
    @csrf

    <h2 class="p-form__title">パスワードリセット</h2>

    <label for="">メールアドレス</label>
    <input type="text" name="email" class="p-form__input @error('email') p-form__is-invalid @enderror" required value="{{ old('email') }}">
    @error('email')
        <span class="p-form__invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror

    <input type="submit" name="submit" class="c-btn" value="パスワード変更メールを送信">
  </form>

</div>
@endsection
