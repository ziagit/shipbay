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
.app {
  height: 100%;
}
.md-card {
  border-radius: 8px !important;
  /* box-shadow: 0 4px 16px rgba(0,0,0,.12); */
  box-shadow: 0 1px 2px #11111142;
  border: none;
}
.md-checkbox .md-checkbox-container {
  border-radius: 5px;
}
.md-raised {
  /* box-shadow: 0 4px 16px rgba(0,0,0,.12) !important; */
  box-shadow: 0 1px 2px #11111142;
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
.info, .question:hover{
 cursor: pointer;
}

.md-table-content{
  border-radius: 8px;
}

.pagination{
  display: flex;
  li{
    list-style-type: none !important;
    margin: 5px 10px;
  }
}

.md-table-content{
  max-width: calc(100vw - 80px);
  overflow-x: auto !important;
}
</style>