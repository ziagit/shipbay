<template>
<md-menu md-direction="bottom-start" class="search-menu" md-align-trigger md-dense>

    <input v-model="keywords" required md-menu-trigger placeholder="Search" />
    <md-menu-content>
        <div v-if="lists">
            <md-menu-item v-if="lists.length === 0 ">Not found</md-menu-item>
        </div>
        <div v-else>
            <md-menu-item>Type</md-menu-item>
        </div>
        <md-menu-item v-for="list in lists" :key="list.id" @click="select(list)">{{ list.name }}</md-menu-item>
    </md-menu-content>
</md-menu>
</template>

<script>
export default {
    name: "Search",
    props: ["data"],
    data: () => ({
        keywords: null,
        lists: null,
    }),
    watch: {
        keywords(after, before) {
            this.$emit('set-data', this.keywords);
        },
        data(data) {
            this.lists = data
        }
    },
    methods: {
        select(selected) {
            this.keywords = selected.name
            this.$emit('get-data', selected)
        }

    }
}
</script>

<style lang="scss" scoped>
.md-menu-content,
.md-menu-content-container {
    border-radius: 0 0 8px 8px !important;
}

input {
    max-width: 80px;
    border: none;
}

input:focus {
    outline: none;
}
</style>>
