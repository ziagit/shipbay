<template>
  <div class="item">
    <div class="icon">
      <img src="http://localhost:8000/images/item.svg" width="100" />
    </div>
    <span class="md-display-1">What items are you shipping?</span>
    <md-card mode="ios" color="light" v-if="items.length > 0">
      <md-card-content>
        <div
          v-show="itemExistError"
          style="color:red"
        >The item you are adding already exist here, please remove it first.</div>
        <ul>
          <li v-for="(item, index) in items" :key="index">
            <div>{{item.description}}, {{Math.round(item.dw)}} Pounds</div>
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
          <md-input v-model="item.description" required></md-input>
        </md-field>
        <md-field>
          <md-select v-model="item.type" name="type" id="type" placeholder="Package type" required>
            <md-option
              v-for="type in itemTypes"
              :key="type.id"
              :value="type.id"
              :typeName="type.title"
            >{{type.title}}</md-option>
          </md-select>
        </md-field>
        <div v-if="item.type" class="change-font">
          <div class="row dimentions">
            <md-field>
              <label>Length (inches)</label>
              <md-input type="number" v-model="item.length" required min="1"></md-input>
            </md-field>
            <md-field>
              <label>Width (inches)</label>
              <md-input type="number" v-model="item.width" required min="1"></md-input>
            </md-field>
            <md-field>
              <label>Height (inches)</label>
              <md-input type="number" v-model="item.height" required min="1"></md-input>
            </md-field>
          </div>
          <div class="row weight">
            <md-field>
              <label>Weight (pounds)</label>
              <md-input type="number" v-model="item.weight" required min="1"></md-input>
            </md-field>
            <md-field>
              <label>Number of items</label>
              <md-input type="number" v-model="item.number" required min="1"></md-input>
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
          class="md-primary"
          @change="checkboxTogal(condition)"
        >{{condition.name}}</md-checkbox>
        <div class="row change-font temperature" v-if="tempTogal">
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
        <md-button to="delivery-services" class="md-icon-button md-raised">
          <md-icon>keyboard_arrow_left</md-icon>
        </md-button>
        <md-button class="md-icon-button md-raised md-primary" type="submit">
          <md-icon>keyboard_arrow_right</md-icon>
          <md-tooltip>Go to carrier list step</md-tooltip>
        </md-button>
      </div>
    </form>
    <md-snackbar
      class="required-feild-error"
      :md-position="snackbar.position"
      :md-duration="snackbar.isInfinity ? Infinity : snackbar.duration"
      :md-active.sync="snackbar.show"
      md-persistent
    >
      <span>All feilds with * sign are required!</span>
      <span style="color:red">(0) is not acceptable!</span>
    </md-snackbar>
  </div>
</template>
<script>
import axios from "axios";
import functions from '../services/functions'
export default {
  name: "Item",
  data: () => ({
    prgValue: 70,
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
      position: "center",
      duration: 5000,
      isInfinity: false,
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
          this.$router.push("result");
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
          this.item.dw = this.calcDw();
          this.items.push({ ...this.item });
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
    watchLocalstorage() {
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
        if(storage.myItem.conditions.length !== 0){
          console.log("list: ", storage.myItem)
          this.myItem.conditions = storage.myItem.conditions;
          if(storage.myItem.conditions.includes('tm')){
            this.myItem.maxTemp = storage.myItem.maxTemp
            this.myItem.minTemp = storage.myItem.minTemp
            this.tempTogal = true
          }
        }
      }
    },
    checkboxTogal(condition) {
      if (condition.code === "tm") {
        this.tempTogal = !this.tempTogal
      }
    },
  },
  created() {
    this.$emit("progress", this.prgValue);
    console.log("in item", JSON.parse(localStorage.getItem("order")));
    this.watchLocalstorage();
    this.getItemType();
    this.getAccessories();
    localStorage.setItem("cRoute", this.$router.currentRoute.path);
  },
};
</script>

<style lang="scss" scoped>
.item {
  text-align: center;
  .row {
    display: flex;
    justify-content: space-between;
  }
  .dimentions {
    .md-field {
      width: 32%;
    }
  }
  .weight,
  .temperature {
    .md-field {
      width: 48%;
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
  .order-summary {
    position: absolute;
    top: 109px;
    right: 0px;
    padding: 20px;
    text-align: left;
  }
  .md-display-1 {
    font-size: 24px;
  }
  .change-font {
    label {
      font-size: 10px;
    }
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

@media only screen and (min-width: 600px) {
  .item {
    .md-display-1 {
      font-size: 30px;
    }
    .change-font {
      label {
        font-size: 14px;
      }
    }
  }
}
</style>