<template>
  <div>
    <div class="form-group">
      <textarea
          id="content"
          name="content"
          v-model="content"
          class="form-control"
          placeholder="Есть что сказать?"
          rows="5"
      ></textarea>
    </div>

    <button @click="addComment" type="submit" class="btn btn-outline-success">Отправить</button>
  </div>
</template>

<script>
export default {

  data() {
    return {
      content: '',
    }
  },
  methods: {
    addComment() {
      axios.post(location.pathname + '/comments', {content: this.content})
      .catch(error => {
        console.log(error.response.data)
      })
      .then(({data}) => {
        this.content = '';
        this.$emit('created', data);
      });
    }

  },
}
</script>
