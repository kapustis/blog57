<template>
  <div class="alert alert-dismissible fade show" :class="`alert-${level}`" role="alert" v-show="show" v-text="body">
<!--    <p>{{ body }}</p>-->
<!--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
  </div>
</template>

<script>
export default {
  name: "Flash",
  props: ['message'],
  data() {
    return {
      body: '',
      show: false,
      level: ''
    }
  },

  created() {
    if (this.message) {
      if (Array.isArray(this.message)) {
        this.flash(this.message);
      } else {
        this.body = this.message;
        this.show = true;
        this.hide();
      }
    }

    window.events.$on( 'flash', data => this.flash(data));
  },

  methods: {
    flash(data) {
      this.body = data.message;
      this.level = data.level;
      this.show = true;
      this.hide();
    },

    hide() {
      setTimeout(() => {
        this.show = false;
      }, 7000);
    }

  }
}
</script>

<style scoped>
.alert {
  position: fixed;
  right: 10rem;
  bottom: 25rem;
}
</style>
