<template>

</template>

<script>
export default {
  name: "Blog-item",
  props: ['post'],
  components: {
    Comments:() => import("../components/Comments"),
  }
}
</script>

<style scoped>

</style>
