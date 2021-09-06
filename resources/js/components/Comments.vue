<template>
  <div class="row d-flex justify-content-center">
    <div class="col-md-12" v-for="(comment, index) in items" :key="comment.id">
      <Comment :data="comment" @deleted="remove(index)"></Comment>
    </div>
    <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    <div v-if="signedIn">
      <NewComment  @created="add"></NewComment>
    </div>
    <p class="text-center" v-else>
      Пожалуйста <a href="/login">авторизируйтесь</a> , чтобы принять участие в обсуждении.
    </p>
  </div>
</template>

<script>

import collection from '../mixins/Collection';
export default {
  name: "Comments",
  components: {
    Comment: () => import("./Comment"),
    NewComment: () => import("./NewComment")
  },

  mixins: [collection],

  data() {
    return {
      dataSet: false,
    }
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch(page) {
      axios.get(this.url(page)).then(this.refresh);
    },
    url(page) {
      if (!page) {
        let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }
      return `${location.pathname}/comments?page=${page}`;
    },
    refresh({data}) {
      this.dataSet = data;
      this.items = data.data;
      // window.scrollTo(0, 500);
    },
  }
}
</script>

<style scoped>
.row{
  margin-bottom: 5em;
}
</style>
