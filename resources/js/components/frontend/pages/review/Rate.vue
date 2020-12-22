<template>
  <div class="rating">
    <star-rating v-model="rating" :star-size="30" @rating-selected="setRating" />
    <Snackbar :data="snackbar" />
  </div>
</template>
<script>
import StarRating from "vue-star-rating";
import Snackbar from "../../../shared/Snackbar";
import axios from "axios";
export default {
  props: ["carrier"],
  data: () => ({
    rating: 0,
    snackbar: {
      show: false,
      message: null,
      statusCode: null,
    },
  }),
  methods: {
    setRating(e) {
      this.rating = e;
      this.submit();
    },
    submit() {
      if (this.rating > 0) {
        axios
          .put("rating/" + this.carrier, { rate: this.rating })
          .then((res) => {
            this.$emit("rated", this.rating);
            this.snackbar.show = true;
            this.snackbar.message = res.data;
            this.snackbar.statusCode = 200;
            console.log("respons", res.data);
          })
          .catch((err) => console.log(err));
      }
    },
  },

  components: {
    StarRating,
    Snackbar,
  },
};
</script>
<style scoped>
.rating {
  text-align: center;
  padding: 30px;
}
</style>
