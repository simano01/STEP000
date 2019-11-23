<template>
  <div>
    <p class="p-form__child-step__title">【STEPフロー】</p>

    <span class="p-form__invalid-feedback p-form__is-invalid valid-show-error" role="alert">
      <strong class="error-description"></strong>
      <strong class="error-title"></strong>
    </span>

      <div v-if="!(step)" class="p-form__child-step__box">
        <label for="" class="p-form__child-step__box__label">1</label>
        <div class="p-form__child-step__box__item">

          <div class="js-count-container">
            <label for="">タイトル</label>
            <input @click="lengthCheck50()" type="text" name="child_title[]" class="p-form__input js-count-title js-count-text50" required>
            <div class="counter-container"><span class="js-show-count-text">0</span>/50</div>
          </div>

          <div class="js-count-container">
            <label for="">内容</label>
            <textarea @click="lengthCheck255()" name="description[]" class="p-form__input js-count-description js-count-text255" required rows="8" cols="80"></textarea>
            <div class="counter-container"><span class="js-show-count-text">0</span>/255</div>
          </div>

          <input type="hidden" name="num[]" value="">
        </div>
      </div>

      <div v-else>
        <div v-for="child_step in child_steps" class="p-form__child-step__box">
          <label for="" class="p-form__child-step__box__label">{{ child_step.num+1 }}</label>
          <div class="p-form__child-step__box__item">
            <label for="">タイトル</label>
            <input :value="child_step.title" type="text" name="child_title[]" class="p-form__input js-count-title js-count-text" required>

            <div class="js-count-container">
              <label for="">内容</label>
              <textarea name="description[]" class="p-form__input js-count-description js-count-text" required rows="8" cols="80">{{ child_step.description }}</textarea>
              <div class="counter-container"><span class="js-show-count-text">0</span>/255</div>
            </div>

            <input type="hidden" name="num[]" value="">
          </div>
        </div>
      </div>

    <button type="button" name="button" class="c-delete_step-btn js-delete_step-btn" @click="deleteForm()"></button>
    <button type="button" name="button" class="c-add_step-btn" @click="addForm()"></button>

    <div v-if="!(step)">
      <input type="submit" name="submit" class="c-btn js-submit-btn" value="登録する">
    </div>
    <div v-else>
      <input type="submit" name="submit" onclick='return confirm("変更しますか？");' class="c-btn js-submit-btn" value="変更する">
    </div>
  </div>
</template>

<script>
  export default {
    props: ["step", "categorys", "achievement_times", "child_steps"],
    data: function() {
      return {
        num: 1,
        err_title_msg: 'STEPフローのタイトルは255文字以内で入力してください',
        err_description_msg: 'STEPフローの内容は255文字以内で入力してください',
        child_title: null,
        description: null,
        title_count: '',
        countText: 0,
      }
    },
    methods: {
      // 子STEP登録フォーム追加
      addForm() {
        if(this.step) {
          var lastNum = $('.p-form__child-step__box__label:last').html()
          this.num = Number(lastNum)
        }
        this.num += 1
        $('.p-form__child-step__box:last').append(
          '<div class="p-form__child-step__box"><label for="" class="p-form__child-step__box__label">'+ this.num + '</label><div class="p-form__child-step__box__item mt7"><div class="js-count-container"><label for="">タイトル</label><input type="text" name="child_title[]" class="p-form__input js-count-title js-count-text50" required><div class="counter-container"><span class="js-show-count-text">0</span>/50</div></div><div class="js-count-container"><label for="">内容</label><textarea name="description[]" class="p-form__input js-count-description js-count-text255" required="required" rows="8" cols="80"></textarea><div class="counter-container"><span class="js-show-count-text">0</span>/255</div></div><input type="hidden" name="num[]" value="">'
        )

        $('.js-delete_step-btn').prop('disabled', false);

        this.lengthCheck50();
        this.lengthCheck255();

      },
      // 子STEP登録フォーム削除
      deleteForm() {
        var lastNum = $('.p-form__child-step__box__label:last').html()
        this.num = Number(lastNum)
        if (this.num <= 1) {
          $('.js-delete_step-btn').prop('disabled', true);
        } else {
          $('.js-delete_step-btn').prop('disabled', false);
          $('.p-form__child-step__box:last').remove();
          console.log(this.num);
        }
      },
      // 文字数カウント（内容）
      lengthCheck255() {
        $('.js-count-text255').on('keyup', function() {
          let count = $(this).val().length
          let err_msg = {
            description: 'STEPフローの内容は255文字以内で入力してください',
          }

          let $targetParent = $(this).parent('.js-count-container');
          let $target = $($targetParent).find('.js-show-count-text');
          $($target).text(count);

          // 文字数が255文字以上の場合、エラーメッセージ表示
          if(count > 255) {
            $('.js-submit-btn').prop('disabled', true);
            $('.error-description').text(err_msg['description']);
          } else {
            $('.js-submit-btn').prop('disabled', false);
            $('.error-description').text('');
          }
        });
      },
      // 文字数カウント（タイトル）
      lengthCheck50() {
        $('.js-count-text50').on('keyup', function() {
          let count = $(this).val().length
          let err_msg = {
            title: 'STEPフローのタイトルは50文字以内で入力してください',
          }

          let $targetParent = $(this).parent('.js-count-container');
          let $target = $($targetParent).find('.js-show-count-text');
          $($target).text(count);

          // 文字数が255文字以上の場合、エラーメッセージ表示
          if(count > 50) {
            $('.js-submit-btn').prop('disabled', true);
            $('.error-title').text(err_msg['title']);
          } else {
            $('.js-submit-btn').prop('disabled', false);
            $('.error-title').text('');
          }
        });
      },
    }
  }
</script>
