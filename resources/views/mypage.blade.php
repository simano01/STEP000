@extends('layouts.app')

@section('content')
  <div class="l-main__mypage">
    <div class="c-two_colum">
      <div class="p-box">
        <div class="p-box__ornament p-box__ornament--b_none">
            <p class="p-box__title">チャレンジSTEP一覧</p>
            <p class="p-box__count">全{{ $charenges->total() }}件 {{ $charenges->currentPage() }}/{{ $charenges->lastPage() }}ページ</p>

            <ul id="charenge_step" class="p-box__list">
              @if ($charenges)
                @foreach ($charenges as $charenge)
                  <charenge-step-component :charenge="{{ json_encode($charenge) }}" :charenge_c_steps="{{ json_encode($charenge_c_steps) }}" :clear_c_steps="{{ json_encode($clear_c_steps) }}"></charenge-step-component>
                @endforeach
              @endif
            </ul>

            {{ $charenges->links() }}
        </div>
        <div class="p-box__ornament p-box__ornament--b_none">
            <p class="p-box__title">登録したSTEP一覧</p>
            <p class="p-box__count">全{{ $steps->total() }}件　{{ $steps->currentPage() }}/{{ $steps->lastPage() }}ページ</p>

            <ul id="step" class="p-box__list">
              @foreach ($steps as $step)
                <step-component :step="{{ json_encode($step) }}"></step-component>
              @endforeach
            </ul>

            {{ $steps->links() }}
        </div>
      </div>
      <div class="p-profile p-box__ornament">
        <div class="p-profile__sp_imgbox">
          <img src="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif" alt="アイコン画像" class="p-profile__img">
          <p class="p-profile__name">@if ($profile){{ $profile->name }}@else名無しさん@endif</p>
        </div>
        <p class="p-profile__introduction">
          @if ($profile)
            {{ $profile->introduction }}
          @else
            プロフィールはまだありません
          @endif
        </p>
        <a href="{{ route('profile.edit', $user_id)}}">
          <button type="button" name="button" class="c-btn">プロフィールを<br class="u-md_on_none">編集する</button>
        </a>
      </div>
    </div>
  </div>
@endsection
