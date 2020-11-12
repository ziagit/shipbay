<template>
<div class="completion">
    <md-card>
        <p style="font-size:20px">Perfect! 👌</p>
        <p>The selected carrier recieved a notification</p>
        <p>Stay in touch, they will contact you as soon as arrive to the pickup location</p>
        <md-button to="/" class="md-primary">Back to home</md-button>
        <md-button class="md-primary">Tracking</md-button>
    </md-card>
</div>
</template>

<script>
export default {
    name: "Complation",
    data: () => ({}),
    updated() {
        window.location.reload()
    },
};
</script>

<style lang="scss" scoped>
.completion {
    max-width: 600px;
    margin: auto;

    .md-card {
        padding: 20px;
        text-align: center;
        margin: 44px auto;
    }
}
</style>
