<template>
  <div class="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style lang="scss">
.pac-icon {
  display: none !important;
}
.pac-item {
  padding: 8px 8px 8px 12px !important;
  font-size: 14px !important;
  cursor: pointer;
}
.pac-item:hover {
  background: #ececec;
}
.pac-item-query {
  font-size: 14px !important;
}
.md-steppers.md-theme-default .md-stepper-header.md-active .md-stepper-number,
.md-steppers.md-theme-default .md-stepper-header.md-done .md-stepper-number {
  background-color: #f0f2f5 !important;
  border: solid 1px #22a92d;
  color: #f0f2f5 !important;
}

.md-steppers.md-theme-default .md-stepper-number,
.md-steppers.md-theme-default .md-stepper-header.md-done .md-stepper-number {
  background-color: #22a92d !important;
  color: #f0f2f5 !important;
}

.section0 {
  box-shadow: 0 2px 13px -7px grey;
}
.md-stepper-label {
  color: #000 !important;
  font-weight: 600;
}
.md-steppers {
  background: none !important;
}
.break {
  min-height: 10px;
}
.md-app-container {
  transform: none !important;
}

.app {
  height: 100% !important;
}

.padding-20 {
  padding: 20px !important;
}
.md-tabs-navigation {
  padding-left: 60px !important;
}
.md-card {
  border-radius: 8px !important;
  /* box-shadow: 0 4px 16px rgba(0,0,0,.12); */
  box-shadow: 0 1px 2px #11111142;
  //box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
  border: none;
}
.md-tabs.md-theme-default .md-tabs-navigation .md-button.md-active {
  background: #448aff24 !important;
}

.md-app .md-app-side-drawer .md-layout-row .md-reveal .md-theme-default {
  border: none !important;
}

.md-checkbox .md-checkbox-container {
  border-radius: 5px;
}

.md-checkbox.md-theme-default.md-checked .md-checkbox-container {
  background-color: #ffa500;
  border-color: #ffa500;
}

.md-radio.md-theme-default.md-checked .md-radio-container {
  background-color: #ffa500;
  border-color: #ffa500;
}

.md-radio.md-theme-default.md-checked .md-radio-container:after {
  background-color: #ef9c03;
}

.md-dialog-container,
.md-dialog-fullscreen {
  border-radius: 12px;
}

.no-shadow-bordered {
  box-shadow: none;
  border: 1px solid #ddd;
}

.md-menu-content {
  border-radius: 8px !important;

  .md-menu-content-container {
    border-radius: 8px !important;
  }
}

.info,
.question:hover {
  cursor: pointer;
}

.md-table-content {
  border-radius: 8px;
}

.pagination {
  display: flex;

  li {
    list-style-type: none !important;
    margin: 5px 10px;
  }
}

.line {
  color: #ddd;
}

.md-table-content {
  max-width: calc(100vw - 80px);
  overflow-x: auto !important;
}

.md-display-1 {
  font-size: 24px;
}

.md-body-1 {
  width: 100% !important;
}

.active {
  color: #ffa500 !important;
}

.md-accent {
  color: #ff5252 !important;
}

.md-list-item {
  .md-list-item-button {
    font-size: 14px !important;

    .md-list-item-content {
      min-height: 35px !important;
    }
  }
}

.hidden-input {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

.company-detail {
  .md-table-cell-container {
    width: 150px !important;
    white-space: nowrap !important;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}

.md-primary {
  color: #ffa500 !important;
}

.md-seconday {
  color: #448aff !important;
}

.md-button.md-theme-default.md-raised:not([disabled]).md-primary {
  background-color: #ffa500;
}

.md-switch.md-theme-default.md-checked.md-primary .md-switch-thumb {
  background-color: #ffa500 !important;
}

.md-switch.md-theme-default.md-checked.md-primary .md-switch-container {
  background-color: #ffa6005b !important;
}

.md-raised {
  border-radius: 30px;
  padding: 0 10px;
  margin: 0;
  background: #ffa500 !important;
  color: #fff !important;
}
.md-button {
  text-transform: none !important; /*For Lower case use lowercase*/
}
.custom-button {
  border-radius: 30px;
  padding: 0 16px !important;
  margin: 0;
  background: #f97d4a;
  color: #fff !important;
  font-weight: 300 !important;
  font-size: 12px !important;
  min-height: 40px !important;
  height: 40px !important;
}

.custom-button-outline {
  border-radius: 30px;
  padding: 0 16px !important;
  margin: 0;
  border: #ffa500 solid 1px !important;
  color: #000 !important;
  font-weight: 400 !important;
  font-size: 12px !important;
  min-height: 40px !important;
  height: 40px !important;
}
.custom-button-outline:hover {
  background: #e4852b !important;
}

.md-progress-bar-fill {
  background: #ffa500 !important;
}
.activeStep .md-stepper-label {
  font-size: 20px !important;
}
@media only screen and (min-width: 600px) {
  .md-display-1 {
    font-size: 30px;
  }

  label {
    font-size: 14px;
  }
}

@media only screen and (max-width: 600px) {
  .section3 {
    .steps {
      .md-list {
        .md-list-item-content {
          padding: 0 !important;

          .md-headline {
            font-size: 14px !important;
          }

          .details {
            font-size: 10px !important;
          }
        }
      }
    }
  }
}
</style>
