<template>
  <li class="p-box__list__item">
    <a :href="/step/ + step.id" class="p-box__list__item__link">
      <span class="p-box__list__item__category u-category">{{ step.name }}</span>
      <p class="p-box__list__item__title">{{ step.title }}</p>
      <p class="p-box__list__item__overview js-text-overflow" v-on:text()>{{ step.overview }}</p>
    </a>
  </li>
</template>

<script>
    export default {
      props: ["step"],
    }
</script>
