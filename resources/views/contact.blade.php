@extends('layouts.app')

@section('content')
  <div class="l-main__contact">
    <form class="p-form" action="{{ route('contact.mail') }}" method="post">
      @csrf

      <h2 class="p-form__title mb5">お問い合わせ</h2>
      <p class="p-form__contact-text">ご質問・ご要望など、お問い合わせの際は、
        <br class="u-md_none">下記項目にご記入の上ご連絡ください。</p>

      <label for="">お名前</label>
      <input type="text" name="name" class="p-form__input @error('name') p-form__is_invalid @enderror" value="{{ old('name') }}">
      @error('name')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <label for="">メールアドレス</label>
      <input type="text" name="email" class="p-form__input @error('email') p-form__is_invalid @enderror" value="{{ old('email') }}">
      @error('email')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <label for="">お問い合わせ内容</label>
      <textarea name="text" class="p-form__input @error('text') p-form__is_invalid @enderror" rows="8" cols="80">{{ old('text') }}</textarea>
      @error('text')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <input type="submit" name="submit" class="c-btn" value="送信する">
    </form>
  </div>
@endsection
