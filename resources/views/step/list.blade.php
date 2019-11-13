@extends('layouts.app')

@section('content')
  <div class="l-main__step-list">

    <div class="p-box">
      <div class="p-box__ornament p-box__ornament--b_none">
        <h2 class="p-box__title">STEP一覧</h2>

        <div class="p-search">
          <form class="p-search__item" action="{{ route('step.search_category') }}" method="post">
            @csrf
            <p class="p-search__item__title">カテゴリ<br class="u-md_block">検索：</p>
            <select class="p-form__input p-form__select @error('category') p-form__is-invalid @enderror" required name="category_id">
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
            <button type="submit" name="button" class="c-btn c-btn__search"><i class="fas fa-search"></i></button>
          </form>
          <form class="p-search__item" action="{{ route('step.search_word') }}" method="post">
            @csrf
            <p class="p-search__item__title">キーワード<br class="u-md_block">検索：</p>
            <input class="p-form__input p-form__select @error('keyword') p-form__is_invalid @enderror" required name="keyword">
            <button type="submit" name="button" class="c-btn c-btn__search"><i class="fas fa-search"></i></button>
          </form>
        </div>

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
