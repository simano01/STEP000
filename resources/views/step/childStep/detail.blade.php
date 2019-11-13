@extends('layouts.app')

@section('content')
  <div class="l-main__child-detail">
    <div class="p-container p-step_detail">
      <div class="p-step_detail__top">
        <div class="p-step_detail__title">
          <span class="u-category">{{ $category->name }}</span>
          <h2 class="p-step_detail__title__text">{{ $step->title }}</h2>
        </div>
      </div>

      <div class="p-step_detail__box">
        <div class="p-step_detail__box__item p-step_detail__box__item--active">
          <span class="p-step_detail__box__item__label">STEP{{ $child_step->num+1 }}：</span>
          <p class="p-step_detail__box__item__title">{{ $child_step->title }}</p>
        </div>
        <p class="p-step_detail__box__text">{{ $child_step->description }}</p>

        @if ($charenge)
          @if ( !($user_id === $step->user_id) && $clear )
            <a href="#" class="p-step_detail__box__charenge-link">
              <button type="button disabled" name="button" class="c-btn c-btn--disabled" disabled>クリア済み</button>
            </a>
          @elseif( !($user_id === $step->user_id) && $before_clear )
            <form class="p-step_detail__box__charenge-link" action="{{ route('childStep.clear', [$step->id, $child_step->id]) }}" method="post">
              @csrf
              <input type="submit" value="クリア" class="c-btn">
            </form>
          @else
            <form class="p-step_detail__box__charenge-link" action="{{ route('childStep.clear', [$step->id, $child_step->id]) }}" method="post">
              @csrf
              <input type="submit" value="クリア" class="c-btn c-btn--disabled" disabled>
            </form>
          @endif
        @endif
        <a href="{{ route('step.detail', $step->id)}}" class="p-step_detail__box__back-link">&lt; STEP詳細へ戻る</a>
      </div>
    </div>
  </div>
@endsection
