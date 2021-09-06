<template>
  <div class="card">
    <div class="card-header">
      <div class="user d-flex flex-row">
        <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img rounded-circle mr-2" :alt="data.owner.name">
        <span class="flex-grow-1">
            <a href="#" class="font-weight-bold text-primary text-decoration-none" v-text="data.owner.name"></a>
        </span>
        <small v-text="ago"></small>
      </div>
    </div>

    <div v-if="editing">
      <div class="card-body">
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
      </div>
      <div class="card-footer">
        <button @click="update" type="button" class="btn btn-sm btn-outline-success">Update</button>
        <button @click="editing = false" type="button" class="btn btn-sm btn-outline-danger">Cancel</button>

      </div>
    </div>

    <div v-else>
      <div class="card-body">
        <p class="card-text" v-html="content"></p>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-sm btn-outline-success">Reply</button>
        <div v-if="authorize('master', data)" style="display: inline-block">
          <button @click="editing = true" type="button" class="btn btn-sm btn-outline-warning">Edit</button>
          <button @click="destroy" type="button" class="btn btn-sm btn-outline-danger">Remove</button>
        </div>
      </div>
    </div>

  </div>
</template>

<script>

import moment from 'moment';

moment.defineLocale('en-foo', {parentLocale: document.documentElement.lang});

export default {
  name: "Comment",
  props: ['data'],
  data() {
    return {
      editing: false,
      id: this.data.id,
      content: this.data.content,
    }
  },

  computed: {
    ago() {
      return moment(this.data.created_at).fromNow();
    },
  },

  methods: {
    update() {
      axios.post(`/comments/${this.data.id}`, {content: this.content,_method: 'patch'})
          .catch(error => {
            console.log(error);
          });
      this.editing = false;
    },
    destroy() {
      axios.delete(`/comments/${this.data.id}`);
      this.$emit('deleted', this.data.id);
    },
  }
}
</script>

<style scoped>

.card {
  border: none;
  box-shadow: 5px 6px 6px 2px #e9ecef;
  border-radius: 4px;
  margin-bottom: 1em;
}

.user-img {
  margin-right: 1em;
}

</style>
