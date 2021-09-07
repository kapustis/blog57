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
        // flash(error.response.data)
        flash('Error! Your answer has not been posted!','danger');
      })
      .then(({data}) => {
        this.content = '';
        this.$emit('created', data);
        flash('Your reply has been posted');
      });
    }
  },
}
</script>
