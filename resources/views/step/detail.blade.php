@extends('layouts.app')

@section('content')
  <div class="l-main__step-detail">
    <div class="p-container p-step_detail">
      <div class="p-step_detail__top">
        <div class="p-step_detail__title">
          <span class="u-category">{{ $category->name }}</span>
          <h2 class="p-step_detail__title__text">{{ $step->title }}</h2>
        </div>
        <a href="{{ route('profile.detail', $step->user_id) }}" class="p-step_detail__creator u-sp_none">
          <span class="p-step_detail__creator-title">作成者</span>
          <img src="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif" alt="アイコン画像" class="p-profile__img">
          <p class="p-step_detail__creator-name js-text-name">@if ($profile){{ $profile->name }} @else 名無しさん @endif</p>
        </a>
      </div>

      <div class="p-step_detail__middle">
        <p>目安達成時間：<span>{{ $achivement_time->time }}</span></p>
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>
      </div>

      <div class="p-step_detail__box">
        <div class="p-step_detail__box__link-wrap">
          @foreach ($child_steps as $child_step)
          <a href="{{ route('childStep.detail', [$step->id, $child_step->id]) }}" class="p-step_detail__box__link">
            <div class="p-step_detail__box__item @if ($clears > $child_step->num)p-step_detail__box__item--active @elseif (!isset($charenge))p-step_detail__box__item--active @endif">
              @if ($clears > $child_step->num)
                <i class="far fa-check-square p-step_detail__box__item__check"></i>
              @else
                <i class="far fa-square p-step_detail__box__item__check"></i>
              @endif
              <span class="p-step_detail__box__item__label">STEP{{ $child_step->num+1 }}：</span>
              <p class="p-step_detail__box__item__title">{{ $child_step->title }}</p>
              <i class="fas fa-chevron-circle-right p-step_detail__box__item__arrow"></i>
            </div>
          </a>
          @endforeach
        </div>

        @if ( $user_id === $step->user_id )
          <a href="{{ route('step.edit', $step->id) }}" class="p-step_detail__box__charenge-link">
            <button type="button" name="button" class="c-btn">編集する</button>
          </a>
        @elseif ( $charenge )
          <a href="#" class="p-step_detail__box__charenge-link">
            <button type="button" name="button" class="c-btn c-btn--disabled" disabled>チャレンジ登録済み</button>
          </a>
        @else
          <form class="p-step_detail__box__charenge-link" action="{{ route('step.charenge', $step->id) }}" method="post">
            @csrf
            <input type="submit" name="submit" value="チャレンジする" class="c-btn">
          </form>
        @endif

        <p class="p-step_detail__creator-title__text u-sp_block">【このSTEPの作成者】</p>
        <div class="p-profile p-box__ornament u-sp_block">
          <div class="p-profile__sp_imgbox">
            <img src="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif" alt="アイコン画像" class="p-profile__img">
            <p class="p-profile__name">@if ($profile){{ $profile->name }}@else名無しさん@endif</p>
          </div>
          <a href="{{ route('profile.detail', $step->user_id) }}" class="u-sp_block p-profile__link">詳しいプロフィールを見る &gt;</a>
        </div>

        <a href="{{ route('step.list') }}" class="p-step_detail__box__back-link">&lt; STEP一覧へ戻る</a>
      </div>
    </div>
  </div>
@endsection
