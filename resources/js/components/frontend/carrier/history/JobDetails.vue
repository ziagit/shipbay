<template>
  <div>
    <md-card>
      <md-card-header>
        <div class="md-title">Shipment details</div>
        <div class="status">
          <span>Status:</span>

          <md-menu md-size="auto" :mdCloseOnSelect="true" v-if="dataLoaded">
            <md-button
              md-menu-trigger
              v-bind:class="{delivered: job.jobstatus.id == 5}"
            >{{job.jobstatus.title}}</md-button>

            <md-menu-content>
              <md-menu-item
                v-for="state in status"
                :key="state.id"
                @click="updateJob(state.id)"
              >{{state.title}}</md-menu-item>
            </md-menu-content>
          </md-menu>
        </div>
      </md-card-header>
      <md-card-content v-if="dataLoaded">
        <div class="src-des">
          <md-card class="src" md-with-hover>
            <md-card-content>
              <h3 class="md-subheading">Pickup details</h3>
              <div class="body-1">Contact name: {{job.shipper.addresses.src_des[0].name}}</div>
              <div class="body-1">Address: {{job.shipper.addresses.src_des[0].address}}</div>
              <div class="body-1">City: {{job.shipper.addresses.src_des[0].city.name}}</div>
              <div
                class="body-1"
              >Zip code: {{job.shipper.addresses.src_des[0].citycode.postal_code}}</div>
              <div class="body-1">Phone: {{job.shipper.addresses.src_des[0].phone}}</div>
              <div class="body-1">Email: {{job.shipper.addresses.src_des[0].email}}</div>
              <div class="body-1">Appointment: {{job.shipper.src_appointment_time}}</div>
            </md-card-content>
          </md-card>
          <md-card class="des" md-with-hover>
            <md-card-content>
              <h3 class="md-subheading">Delivery details</h3>
              <div class="body-1">Contact name: {{job.shipper.addresses.src_des[1].name}}</div>
              <div class="body-1">Address: {{job.shipper.addresses.src_des[1].address}}</div>
              <div class="body-1">City: {{job.shipper.addresses.src_des[1].city.name}}</div>
              <div
                class="body-1"
              >Zip code: {{job.shipper.addresses.src_des[1].citycode.postal_code}}</div>
              <div class="body-1">Phone: {{job.shipper.addresses.src_des[1].phone}}</div>
              <div class="body-1">Email: {{job.shipper.addresses.src_des[1].email}}</div>
              <div class="body-1">Appointment: {{job.shipper.des_appointment_time}}</div>
            </md-card-content>
          </md-card>
        </div>

        <md-card class="items" md-with-hover>
          <md-card-content>
            <h3 class="md-subheading">Items</h3>
            <div v-for="item in job.shipper.items" :key="item.id">
              <div class="body-1">{{item.description}}, {{item.dimentional_weight}} Pounds</div>
            </div>
            <div>
              <h3 class="md-subheading">Item conditions</h3>
              <div class="body-1">Min temperature(FH) {{job.shipper.min_temperature}}</div>
              <div class="body-1">Max temperature(FH) {{job.shipper.max_temperature}}</div>
            </div>
          </md-card-content>
        </md-card>

        <md-card class="shipper" md-with-hover>
          <md-card-content>
            <h3 class="md-subheading">Shippment general info</h3>
            <div class="body-1">Pickup date: {{job.shipper.pickup_date}}</div>
            <div class="body-1">Start loadtime: {{job.shipper.start_loadtime}}</div>
            <div class="body-1">End loadtime: {{job.shipper.end_loadtime}}</div>
            <div class="body-1">Estimated item value: ${{job.shipper.estimated_value}}</div>
            <div class="body-1">Cost: ${{Math.round(job.shipper.cost)}}</div>
          </md-card-content>
        </md-card>
      </md-card-content>
      <md-card-actions>
        <md-button class="md-icon-button mark-as-read" @click="markAsRead()">
          <md-icon>done</md-icon>
          <md-tooltip>Mark as read</md-tooltip>
        </md-button>
      </md-card-actions>
    </md-card>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "JobDetails",
  data: () => ({
    job: null,
    active: false,
    hasHistory: false,
    notification: null,
    notificationId: null,
    dataLoaded: false,
    status: [],
    selectedStatus: null,
  }),
  methods: {
    jobDetails() {
      axios
        .get("job-details/" + this.$route.params.id)
        .then((res) => {
          this.job = res.data;
          if (this.job != null) {
            this.dataLoaded = true;
          }
          console.log("job ", res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    markAsRead() {
      axios
        .get("auth/read-notification/" + this.notificationId)
        .then((res) => {
          console.log(res.data);
          this.$router.replace("../jobs");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    
    updateJob(statusId) {
      axios
        .post("update-job/" + this.$route.params.id, {
          status: statusId,
        })
        .then((res) => {
          this.job = res.data;
          console.log("updated job: ", res.data)
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getJobStatus() {
      axios
        .get("job-status")
        .then((res) => {
          this.status = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.jobDetails();
    this.getJobStatus();
    this.notificationId = this.$store.state.shared.notificationId;
  },
  watch: {
    $route() {
      this.notificationId = this.$store.state.shared.notificationId;
      this.jobDetails();
    },
  },
};
</script>
<style lang="scss" scoped>
.md-card {
  text-align: left;
  .md-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: right;
    .status {
      display: flex;
      align-items: center;
      .delivered {
        color: green !important;
      }
    }
  }
  .md-subheading {
    font-weight: 410;
  }
  .md-card {
    margin: 5px;
  }
  .src-des {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    .src {
      flex: 1;
    }
    .des {
      flex: 1;
    }
  }
}
</style>