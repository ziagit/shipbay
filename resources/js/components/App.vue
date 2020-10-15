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
    height: 100% !important;
}

.padding-20 {
    padding: 20px !important;
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

.md-dialog-container,
.md-dialog-fullscreen {
    border-radius: 12px;
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
    color: #448aff !important;
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

@media only screen and (min-width: 600px) {
    .md-display-1 {
        font-size: 30px;
    }

    .md-body-1 {
        width: 50% !important;
    }

    label {
        font-size: 14px;
    }
}
</style>
