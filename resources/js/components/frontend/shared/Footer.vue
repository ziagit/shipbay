<template>
<div class="footer">
    <div>Section1</div>
    <div>Section2</div>
    <div>Section3</div>
</div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss" scoped>
.footer {
    background: #333;
    color: #fff;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    min-height: 150px;
    padding: 20px;
}
</style>
