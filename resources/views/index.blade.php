@extends('layouts.app')

@section('content')


  <div class="l-main__home">

    <section class="p-hero">
      <p class="p-hero__subtitle">あなたの人生のSTEPを共有しよう！</p>
      <div class="p-hero__title">
        <h2 class="p-hero__title__text">STEP</h2>
        <img src="{{ asset('img/header-icon.png') }}" alt="ヘッダーアイコンの階段" class="p-hero__title__img">
      </div>
      @guest 
        <a href="{{ route('register') }}">
          <button type="button" name="button" class="c-btn c-btn__primary">つかってみる</button>
        </a>
        <a href="{{ route('login') }}"><p class="p-hero__login-link">ログインする</p></a>
      @endguest
      @auth 
        <a href="{{ route('mypage') }}">
          <button type="button" name="button" class="c-btn c-btn__primary">マイページへ</button>
        </a>
      @endauth
    </section>

    <section class="p-container">
      <div class="p-container__ornament">
        <h3 id="describe_step" class="p-container__ornament__title">STEPってどんなサービス？</h3>
        <p class="p-container__ornament__text">
          何を学ぶのにも人それぞれ「これが良かった」という「順番」と「内容」があります。<br>
          人それぞれの「この順番でこういったものを学んでいったのが良かった」という「STEP」を投稿し、
          他の人はそれを見ながらその「STEP」を元に学習を進めていけるサービスです。
        </p>
      </div>
      <div class="p-container__ornament">
        <h3 class="p-container__ornament__title">こんな人にオススメ！</h3>
        <ul class="p-container__ornament__list">
          <li class="p-container__ornament__list__item">
            <i class="far fa-check-square"></i>
            <p>効率よく学習したい</p>
          </li>
          <li class="p-container__ornament__list__item">
            <i class="far fa-check-square"></i>
            <p>何から始めれば良いか分からない</p>
          </li>
          <li class="p-container__ornament__list__item">
            <i class="far fa-check-square"></i>
            <p>ほかの人の学習手順が知りたい</p>
          </li>
        </ul>
      </div>
      @guest 
        <a href="{{ route('register') }}">
          <button type="button" name="button" class="c-btn c-btn__primary">つかってみる</button>
        </a>
      @endguest 
    </section>

  </div>
@endsection
