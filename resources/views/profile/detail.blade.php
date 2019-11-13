@extends('layouts.app')

@section('content')
  <div class="l-main__profDetail">

    <div class="p-prf_detail">
      <div class="p-prf_detail__box">
        <p class="p-prf_detail__box__name">
          @if ($profile)
            {{ $profile->name }}
          @else
            名無しさん
          @endif
        </p>
      </div>
      <div class="p-prf_detail__box">
        <img src="@if($profile && $profile->image) {{ $profile->image }} @else {{ asset('img/no_img2.png') }} @endif" alt="アイコン画像" class="p-profile__img p-profile__detail-img">
        <p class="p-prf_detail__box__introduction p-prf_detail__box__num">
          @if ($profile)
            {{ $profile->introduction }}
          @else
            プロフィールはまだありません
          @endif
        </p>
      </div>
    </div>

    <div class="p-box">
      <div class="p-box__ornament p-box__ornament--b_none">
          <p class="p-box__title">@if($profile){{ $profile->name }}@else名無しさん@endifのSTEP一覧</p>
          <p class="p-box__count">全{{ $steps->total() }}件　{{ $steps->currentPage() }}/{{ $steps->lastPage() }}ページ</p>

          <ul id="step" class="p-box__list">
            @foreach ($steps as $step)
              <step-component :step="{{ json_encode($step) }}"></step-component>
            @endforeach
          </ul>

          {{ $steps->links() }}
      </div>
    </div>

  </div>
@endsection
