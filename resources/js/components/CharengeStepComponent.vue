<template>
  <li class="p-box__list__item">
    <a :href="/step/ + charenge.id" class="p-box__list__item__link">
      <span class="p-box__list__item__category u-category">{{ charenge.name }}</span>
      <p class="p-box__list__item__title">{{ charenge.title }}</p>
      <p class="p-box__list__item__overview js-text-overflow">{{ charenge.overview }}</p>
      <span class="p-box__list__parameter">
        <span class="p-box__list__parameter__item" :style="'width:' + progressParamNum() + '%;'">
          <span class="p-box__list__parameter__item__num">{{ paramNum }}%</span>
        </span>
      </span>
    </a>
  </li>
</template>

<script>
    export default {
      props: ["charenge", "charenge_c_steps", "clear_c_steps"],
      data: function() {
        return {
          paramNum: 0,
          charengeStepId: this.charenge.step_id,
          clearStep: this.clear_c_steps,
          charenges: this.charenge,
        }
      },
      methods: {
        // 進捗パラメータ
        progressParamNum() {
          if(this.charenges && this.clearStep) {
            // チャレンジに登録した子ステップの総数を計算
            let charengeStepId = this.charengeStepId
            let childSteps = this.charenge_c_steps.filter(function(item, index){
              if(item.step_id === charengeStepId) return true
            }).length

            // クリアした子ステップの総数を計算
            let clearStep = this.clearStep
            let clearChildSteps = []
            for (var i = 0; i < this.clearStep.length; i++) {
              if(clearStep[i].step_id === this.charenges.step_id) {
                 clearChildSteps.push(clearStep[i])
              }
            }
            let clearChildStepsNum = clearChildSteps.length

            // クリアした子ステップの割合を計算
            this.paramNum = (clearChildStepsNum / childSteps) * 100;
          } else {
            this.paramNum = 0;
          }

          return this.paramNum;

        },
      }
    }
</script>
