<template>
<div class="header">
    <div class="left">
        <md-button class="md-icon-button" @click="$emit('togal-menu')">
            <md-icon>menu</md-icon>
        </md-button>
        <h3 @click="$router.push('/')"><span>Shipping </span> TAP</h3>
    </div>
    <div class="right">
        <md-button class="md-icon-button" @click="track()">
            <md-icon>location_on</md-icon>
        </md-button>
        <span @click="$router.push('/')">Track</span>
    </div>

</div>
</template>

<script>
export default {
    name: "Headder",
    data: () => ({

    }),
    methods: {

    },
    created() {},

}
</script>

<style lang="scss" scoped>
.header {
    position: fixed;
    z-index: 9;
    margin: 0;
    display: flex;
    justify-content: space-between;
    color: #fff;
    align-items: center;
    padding: 0 10px;
    width: 100%;
    top: 0;
    left: 0;

    .md-icon {
        color: #fff;
    }

    .left {
        display: flex;
        align-items: center;

        h3 {
            span {
                font-family: "Segoe Script", Helvetica, Arial;
                font-size: 20px;

            }
        }
    }

    .right {
        display: flex;
        align-items: center;
        padding-right: 20px;

        .md-button {
            margin: 0;
        }
    }

}
</style>
