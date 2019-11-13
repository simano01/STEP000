@extends('layouts.app')

@section('content')
  <div class="l-main__step-register">
    <div class="p-form">
      <form class="" action="{{ route('step.update', $step->id) }}" method="post">
        @method('PUT')
        @csrf

        <h2 class="p-form__title mb5">STEPの編集</h2>

        <label for="">タイトル</label>
        <input type="text" name="title" class="p-form__input @error('title') p-form__is_invalid @enderror required" value="{{ $step->title }}">
        @error('title')
            <span class="p-form__invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="">概要</label>
        <textarea name="overview" class="p-form__input @error('overview') p-form__is_invalid @enderror required" rows="8" cols="80">{{ $step->overview }}</textarea>
        @error('overview')
            <span class="p-form__invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="">カテゴリ</label>
        <select class="p-form__input p-form__select @error('overview') p-form__is_invalid @enderror required" name="category_id">
          @foreach ($categorys as $category)
            <option value="{{ $category->id }}" @if ($category->id === $step->category_id) selected @endif>{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')
            <span class="p-form__invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="">目安達成時間</label>
        <select class="p-form__input p-form__select @error('overview') p-form__is_invalid @enderror required" name="achievement_time_id">
          @foreach ($achievement_times as $achievement_time)
            <option value="{{ $achievement_time->id }}" @if($achievement_time->id === $step->achievement_time_id) selected @endif>{{ $achievement_time->time }}</option>
          @endforeach
        </select>
        @error('achievement_time_id')
            <span class="p-form__invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div id="child_step-register" class="p-form__child-step">
          <child-step-register-component :step="{{ json_encode($step) }}" :categorys="{{ json_encode($categorys) }}" :achievement_times="{{ json_encode($achievement_times) }}" :child_steps="{{ json_encode($child_steps) }}"></child-step-register-component>
        </div>

      </form>

      <form class="" action="{{ route('step.delete', $step->id) }}" method="post">
        @method('delete')
        @csrf
        <input type="submit" name="submit" class="p-form__c-btn c-btn c-btn__primary mr20p" onclick='return confirm("削除しますか？");' value="削除する">
      </form>
    </div>


  </div>
@endsection
