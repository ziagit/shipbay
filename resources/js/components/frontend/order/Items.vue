<template>
  <div class="item">
    <md-card mode="ios" color="light" v-if="items.length > 0">
      <md-card-content>
        <div v-show="itemExistError" style="color: red">
          The item you are adding already exist here, please remove it first.
        </div>
        <ul>
          <li v-for="(item, index) in items" :key="index">
            <div>{{ item.description }}, {{ Math.round(item.dw) }} Pounds</div>
            <div>
              <md-button class="md-icon-button" @click="editItem(item)">
                <md-icon>edit</md-icon>
              </md-button>
              <md-button class="md-icon-button" @click="removeItem(index)">
                <md-icon>close</md-icon>
              </md-button>
            </div>
          </li>
        </ul>
      </md-card-content>
    </md-card>
    <form @submit.prevent="nextStep()">
      <div class="items">
        <md-field>
          <label>Item description</label>
          <md-input
            v-model="item.description"
            ref="focusable"
            required
          ></md-input>
        </md-field>
        <md-field>
          <md-select
            v-model="item.type"
            name="type"
            id="type"
            placeholder="Package type"
          >
            <md-option
              v-for="i in itemTypes"
              :key="i.id"
              :value="i.id"
              :typeName="i.title"
              >{{ i.title }}</md-option
            >
          </md-select>
          <input class="hidden-input" v-model="item.type" required />
        </md-field>
        <div v-if="item.type">
          <div class="row row1">
            <md-field>
              <label>Length (inches)</label>
              <md-input
                type="number"
                v-model="item.length"
                required
                min="1"
              ></md-input>
            </md-field>
            <md-field>
              <label>Width (inches)</label>
              <md-input
                type="number"
                v-model="item.width"
                required
                min="1"
              ></md-input>
            </md-field>
            <md-field>
              <label>Height (inches)</label>
              <md-input
                type="number"
                v-model="item.height"
                required
                min="1"
              ></md-input>
            </md-field>
          </div>
          <div class="row row2">
            <md-field>
              <label>Weight (pounds)</label>
              <md-input
                type="number"
                v-model="item.weight"
                required
                min="1"
              ></md-input>
            </md-field>
            <md-field>
              <label>Number of items</label>
              <md-input
                type="number"
                class="md-primary"
                v-model="item.number"
                required
                min="1"
              ></md-input>
            </md-field>
          </div>
        </div>
      </div>
      <md-button class="md-icon-button btn-add" @click="addMore">
        <md-icon>add</md-icon>
        <md-tooltip>Add another item</md-tooltip>
      </md-button>
      <div class="options">
        <md-checkbox
          v-for="condition in accessories"
          :key="condition.id"
          v-model="myItem.conditions"
          :value="condition.code"
          @change="checkboxTogal(condition)"
          >{{ condition.name }}</md-checkbox
        >
        <div class="row row3" v-if="tempTogal">
          <md-field>
            <label>Min temperature (FH)</label>
            <md-input v-model="myItem.minTemp" :required="tempTogal"></md-input>
          </md-field>
          <md-field>
            <label>Max temperature (FH)</label>
            <md-input v-model="myItem.maxTemp" :required="tempTogal"></md-input>
          </md-field>
        </div>
      </div>
      <div class="action">
        <md-button class="custom-button" type="submit"> Continue </md-button>
      </div>
    </form>
    <Snackbar :data="snackbar" />
  </div>
</template>

<script>
import axios from "axios";
import functions from "../services/functions";
import Snackbar from "../../shared/Snackbar";
export default {
  name: "Item",
  data: () => ({
    myItem: {
      conditions: [],
      minTemp: null,
      maxTemp: null,
    },
    item: {
      description: null,
      length: null,
      width: null,
      height: null,
      weight: null,
      number: 1,
      type: null,
      dw: null,
    },
    items: [],
    pushed: false,
    itemTypes: null,
    typeName: null,
    accessories: null,
    checker: false,
    tempTogal: false,
    itemExistError: false,
    snackbar: {
      show: false,
      message: "All feilds with * sign are required!",
      statusCode: "(0) is not acceptable!",
    },
  }),

  methods: {
    nextStep() {
      if (this.validator()) {
        if (!this.itemExist()) {
          let storage = JSON.parse(localStorage.getItem("order"));
          this.item.dw = functions.calcDw(this.item);
          this.items.push(this.item);
          this.myItem["items"] = this.items;
          storage.myItem = this.myItem;
          localStorage.setItem("order", JSON.stringify(storage));

          this.$emit("progress", "sixth", "seventh", "carriers", 6);
        } else {
          this.itemExistError = !this.itemExistError;
        }
      } else {
        this.snackbar.show = true;
      }
    },
    validator() {
      if (
        this.item.description == null ||
        this.item.type == null ||
        this.item.length == null ||
        this.item.width == null ||
        this.item.height == null ||
        this.item.weight == null ||
        this.item.number == null
      ) {
        return false;
      } else {
        return true;
      }
    },
    addMore() {
      if (this.validator()) {
        if (!this.itemExist()) {
          let storage = JSON.parse(localStorage.getItem("order"));
          this.item.dw = functions.calcDw(this.item);
          this.items.push({
            ...this.item,
          });
          this.myItem["items"] = this.items;
          storage.myItem = this.myItem;
          localStorage.setItem("order", JSON.stringify(storage));
          this.item.description = null;
          this.item.length = null;
          this.item.width = null;
          this.item.height = null;
          this.item.weight = null;
          this.item.number = null;
          this.item.type = null;
          this.itemExistError = false;
        } else {
          this.itemExistError = !this.itemExistError;
          console.log("Item already exist.");
        }
      } else {
        this.snackbar.show = true;
        console.log("All feilds with * sign are required!");
      }
    },
    itemExist() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.myItem != undefined) {
        let found = storage.myItem.items.filter(
          (obj) => obj.description === this.item.description
        );
        if (found.length > 0) {
          return true;
        } else {
          return false;
        }
      }
    },

    getAccessories() {
      axios
        .get("item-condition")
        .then((res) => {
          this.accessories = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    getItemType() {
      axios
        .get("item-type")
        .then((res) => {
          this.itemTypes = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    removeItem(index) {
      this.items.splice(index, 1);
      let storage = JSON.parse(localStorage.getItem("order"));
      storage.myItem.items.splice(index, 1);
      localStorage.setItem("order", JSON.stringify(storage));
    },
    editItem(item) {
      let storage = JSON.parse(localStorage.getItem("order"));
      this.item.description = item.description;
      this.item.type = item.type;
      this.item.length = item.length;
      this.item.width = item.width;
      this.item.height = item.height;
      this.item.weight = item.weight;
      this.item.number = item.number;
    },
    init() {
      let storage = JSON.parse(localStorage.getItem("order"));
      if (storage.myItem) {
        if (storage.myItem.items.length > 0) {
          this.items = storage.myItem.items;
          let lastElement =
            storage.myItem.items[storage.myItem.items.length - 1];
          this.item.description = lastElement.description;
          this.item.type = lastElement.type;
          this.item.length = lastElement.length;
          this.item.width = lastElement.width;
          this.item.height = lastElement.height;
          this.item.weight = lastElement.weight;
          this.item.number = lastElement.number;
        }
        if (storage.myItem.conditions.length !== 0) {
          this.myItem.conditions = storage.myItem.conditions;
          if (storage.myItem.conditions.includes("tm")) {
            this.myItem.maxTemp = storage.myItem.maxTemp;
            this.myItem.minTemp = storage.myItem.minTemp;
            this.tempTogal = true;
          }
        }
      }
    },
    checkboxTogal(condition) {
      if (condition.code === "tm") {
        this.tempTogal = !this.tempTogal;
      }
    },
  },
  mounted() {
    this.$refs.focusable.$el.focus();
  },
  created() {
    this.init();
    this.getItemType();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
  components: {
    Snackbar,
  },
};
</script>

<style lang="scss" scoped>
.item {
  text-align: center;

  .row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;

    .md-field {
      flex: 30%;
      margin: 0 2px;

      label {
        font-size: 11px;
      }
    }
  }

  .icon,
  .options,
  .action {
    margin: 20px 0;
  }

  .btn-close {
    position: relative;
    float: right;
  }

  .md-card {
    ul {
      padding: 0;

      li {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
    }
  }

  .required-feild-error {
    background: crimson;
  }
}
</style>
