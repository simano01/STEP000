/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue'
// import router from './router'
// import store from './store'
// import App from './App.vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('step-component', require('./components/StepComponent.vue').default);
Vue.component('charenge-step-component', require('./components/CharengeStepComponent.vue').default);
Vue.component('child-step-register-component', require('./components/ChildStepRegisterComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  el: '#charenge_step',
});

new Vue({
  el: '#step',
})

new Vue({
  el: '#child_step-register',
})


$(function(){

  //文字数カウント（STEP概要、プロフィール内容）
  $('.js-count-text255').on('keyup', function() {
    let count = $(this).val().length;
    let err_msg = {
      overview: 'STEPの概要は255文字以内で入力してください',
      introduction: 'プロフィールは255文字以内で入力してください',
    }

    let $targetParent = $(this).parent('.js-count-container');
    let $target = $($targetParent).find('.js-show-count-text');
    $($target).text(count);

    if(count > 255) {
      $('.js-submit-btn').prop('disabled', true);

      if($(this).hasClass('js-count-overview')) {
        $('.error-overview').text(err_msg['overview']);
      }else{
        $('.error-introduction').text(err_msg['introduction']);
      }
    } else {
      $('.js-submit-btn').prop('disabled', false);

      if($(this).hasClass('js-count-overview')) {
        $('.error-overview').text('');
      }else{
        $('.error-introduction').text('');
      }
    }
  });

  //文字数カウント（STEPタイトル、プロフィール名前）
  $('.js-count-text50').on('keyup', function() {
    let count = $(this).val().length;
    let err_msg = {
      title: 'STEPフローのタイトルは50文字以内で入力してください',
      name: '名前は50文字以内で入力してください',
    }

    let $targetParent = $(this).parent('.js-count-container');
    let $target = $($targetParent).find('.js-show-count-text');
    $($target).text(count);

    if(count > 50) {
      $('.js-submit-btn').prop('disabled', true);
      if($(this).hasClass('js-count-title')) {
        $('.error-parent_title').text(err_msg['title']);
      }else{
        $('.error-name').text(err_msg['name']);
      }
    } else {
      $('.js-submit-btn').prop('disabled', false);
      if($(this).hasClass('js-count-title')) {
        $('.error-parent_title').text('');
      }else{
        $('.error-name').text('');
      }
    }
  });

  // 文字数制限（STEP概要）
  $('.js-text-overflow').each(function() {
    var $target = $(this);
    var html = $target.html();
    var maxNum = 50;

    if(html.length > maxNum) {
      html = html.substr(0, maxNum);
      $target.html(html + ' ...');
    }
  });

  // 文字数制限（プロフィール名前）
  $('.js-text-name').each(function() {
    var $target = $(this);
    var html = $target.html();
    var maxNum = 9;

    if(html.length > maxNum) {
      html = html.substr(0, maxNum);
      $target.html(html + '...');
    }
  });

  // 画像ライブプレビュー
  var $dropArea = $('.area-drop');
  var $fileInput = $('.input-file');
  $dropArea.on('dragover', function(e){
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '3px #ccc dashed');
  });
  $dropArea.on('dragleave', function(e){
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', 'none');
  });
  $fileInput.on('change', function(e){
    $dropArea.css('border', 'none');
    $dropArea.toggleClass('active');
    var file = this.files[0],
        $img = $(this).siblings('.prev-img'),
        fileReader = new FileReader();
    fileReader.onload = function(event) {
      $img.attr('src', event.target.result).show();
    };
    fileReader.readAsDataURL(file);
  });

  // フロートヘッダー
  var targetHeight = $('.js-float-menu-target').height();
  $(window).on('scroll', function() {
    $('.js-float-menu').toggleClass('active', $(this).scrollTop() > 200);
  });

  // グローバルメニュー
  $('.js-toggle-menu').on('click', function () {
    $(this).toggleClass('active');
    $('.js-toggle-menu-target').toggleClass('active');
  });

  // フッターを最下部に固定
  var $ftr = $('.js-footer');
  if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
    $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
  }

  // メッセージトグル表示
  var $jsShowMsg = $('.js-show-msg');
  var msg = $jsShowMsg.text();
  if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
    $jsShowMsg.slideToggle('slow');
    setTimeout(function(){ $jsShowMsg.slideToggle('slow'); }, 5000);
  }

});
