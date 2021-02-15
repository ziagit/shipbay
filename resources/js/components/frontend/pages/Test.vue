<template>
  <div>
    <ul>
      <li>
        <div class="title" @click="toggle(1)">Title</div>
        <div class="body" v-if="isActive">Body</div>
      </li>
      <li>
        <div class="title" @click="toggle(2)">Title</div>
        <div class="body" v-if="isActive">Body</div>
      </li>
      <li>
        <div class="title" @click="toggle(3)">Title</div>
        <div class="body" v-if="isActive">Body</div>
      </li>
      <li>
        <div class="title" @click="toggle(4)">Title</div>
        <div class="body" v-if="isActive">Body</div>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  data: () => ({
    isActive: false,
  }),
  methods: {
    toggle(id) {
      this.isActive = !this.isActive;
    },
  },
};
</script>
<style scoped lang="scss"></style>
