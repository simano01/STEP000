<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="STEP(ステップ)は、仕事、趣味、学習など様々なカテゴリの'学習手順'と'内容'を投稿できるサービスです。人それぞれのSTEPを元に効率の良く学習を進められます。">
    <meta name="keywords" content="ステップ, 方法, 学習, step, 効率, 手順, 順番">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>STEP</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>

    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
      <div class="alert js-show-msg" role="alert" style="display: none;">
        {{ session('flash_message') }}
      </div>
    @endif

    <header class="l-header js-float-menu">
      @guest 
        <a href="{{ asset('/')  }}" class="l-header__logo">
          <h1 class="l-header__logo__text">STEP</h1>
          <img src="{{ asset('img/header-icon.png') }}" alt="ヘッダーアイコンの階段" class="l-header__logo__img">
        </a>
      @endguest
      @auth
        <a href="{{ asset('/mypage')  }}" class="l-header__logo">
          <h1 class="l-header__logo__text">STEP</h1>
          <img src="{{ asset('img/header-icon.png') }}" alt="ヘッダーアイコンの階段" class="l-header__logo__img">
        </a>
      @endauth
      <div class="l-header__menu__trigger js-toggle-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <nav class="l-header__nav js-toggle-menu-target">
        <ul class="l-header__manu">
          @guest
            <li class="l-header__menu__item">
              <a href="{{ route('login') }}" class="l-header__menu__link"><i class="fas fa-sign-in-alt"></i>ログイン</a>
            </li>
            <li class="l-header__menu__item">
              <a href="{{ route('register') }}" class="l-header__menu__link"><i class="fas fa-user"></i>ユーザー登録</a>
            </li>
            <li class="l-header__menu__item">
              <a href="/#describe_step" class="l-header__menu__link"><i class="fas fa-question-circle"></i>STEPってなに？</a>
            </li>
            <li class="l-header__menu__item">
              <a href="{{ route('contact') }}" class="l-header__menu__link"><i class="fas fa-envelope"></i>お問い合わせ</a>
            </li>
          @endguest
          @auth
            <li class="l-header__menu__item">
              <a href="{{ route('mypage') }}" class="l-header__menu__link"><i class="fas fa-home"></i>マイページ</a>
            </li>
            <li class="l-header__menu__item">
              <a href="{{ route('step.register') }}" class="l-header__menu__link"><i class="fas fa-edit"></i>STEPを登録</a>
            </li>
            <li class="l-header__menu__item">
              <a href="{{ route('step.list') }}" class="l-header__menu__link"><i class="fas fa-folder"></i>STEP一覧</a>
            </li>
            <li class="l-header__menu__item">
              <a href="{{ route('contact') }}" class="l-header__menu__link"><i class="fas fa-envelope"></i>お問い合わせ</a>
            </li>
            <li class="l-header__menu__item">
              <a class="dropdown-item l-header__menu__link" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                 <i class="fas fa-sign-out-alt"></i>ログアウト
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          @endauth
        </ul>
      </nav>
    </header>

    <main class="l-main">
      @yield('content')
    </main>

    <footer class="l-footer js-footer">
      <p class="p-footer__text">Copyright @ simano</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  </body>
</html>
