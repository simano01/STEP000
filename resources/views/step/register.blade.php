@extends('layouts.app')

@section('content')
  <div class="l-main__step-register">
    <form class="p-form" action="{{ route('step.create') }}" method="post">
      @csrf

      <h2 class="p-form__title mb5">STEPの新規登録</h2>

      <div class="js-count-container">
        <label for="">タイトル</label>
        <input type="text" name="title" class="p-form__input js-count-text50 js-count-title @error('title') p-form__is-invalid @enderror" required value="{{ old('title') }}">
        <div class="counter-container"><span class="js-show-count-text">0</span>/50</div>

        <span class="p-form__invalid-feedback p-form__is-invalid" role="alert">
            <strong class="error-parent_title">@error('title'){{ $message }}@enderror</strong>
        </span>
      </div>

      <div class="js-count-container">
        <label for="">概要</label>
        <textarea name="overview" class="p-form__input js-count-text255 js-count-overview @error('overview') p-form__is-invalid @enderror" required rows="8" cols="80">{{ old('overview') }}</textarea>
        <div class="counter-container"><span class="js-show-count-text">0</span>/255</div>

        <span class="p-form__invalid-feedback p-form__is-invalid" role="alert">
            <strong class="error-overview">@error('overview'){{ $message }}@enderror</strong>
        </span>
      </div>

      <label for="">カテゴリ</label>
      <select class="p-form__input p-form__select @error('category_id') p-form__is-invalid @enderror" required name="category_id">
        <option value="">選択してください</option>
        @foreach ($categorys as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <label for="">目安達成時間</label>
      <select class="p-form__input p-form__select @error('achievement_time_id') p-form__is-invalid @enderror" required name="achievement_time_id">
        <option value="">選択してください</option>
        @foreach ($achievement_times as $achievement_time)
          <option value="{{ $achievement_time->id }}">{{ $achievement_time->time }}</option>
        @endforeach
      </select>
      @error('achievement_time_id')
          <span class="p-form__invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div id="child_step-register" class="p-form__child-step">
        <child-step-register-component></child-step-register-component>
      </div>


    </form>
  </div>
@endsection
