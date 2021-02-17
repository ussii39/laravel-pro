<template>
  <div>
    <input type="text" v-model="keyword" />
    {{ message }}

    <div v-for="(item, index) in items" :key="index">
      <a :href="item.url" target="_blank">
        {{ item.title }}
      </a>
      いいね数{{ item.likes_count }}
    </div>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";

export default {
  name: "qiita",

  data() {
    return {
      items: [],
      keyword: "",
      message: "",
    };
  },
  watch: {
    keyword() {
      this.message = "waiting for ";
      this.debouncedGetAnswer();
    },
  },
  created: function () {
    // this.keyword === "javascript";
    // this.input();
    this.debouncedGetAnswer = _.debounce(this.input, 500);
  },

  methods: {
    input() {
      if (this.keyword === "") {
        this.items = null;
        this.message = "";
        return;
      }
      this.message = "....Loading";
      var vm = this;
      var params = { page: 1, per_page: 20, query: this.keyword };
      axios
        .get("https://qiita.com/api/v2/items", { params })
        .then((res) => (this.items = res.data))
        .catch((err) => {
          vm.message = "Error" + err;
        })
        .finally(() => {
          vm.message = "";
        });
    },
  },
};
</script>

<style scoped></style>