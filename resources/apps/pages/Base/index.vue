<template>
    <v-app v-cloak>
        <v-navigation-drawer v-model="$root.drawer" app>
            <v-auth-user />
            <v-auth-menus :menus="menus" />

            <template #append>
                <v-col class="caption text-center" cols="12">Copyright &copy; {{ new Date().getFullYear() }} Monoland</v-col>
            </template>
        </v-navigation-drawer>

        <v-page-toolbar @update="dialogPost" app />

        <v-content :class="`${$root.theme} lighten-5`">
            <router-view :key="$route.path"></router-view>
        </v-content>

        <v-page-upload />

        <v-snackbar v-model="snackbar.state" :color="snackbar.color" :timeout="3500">
            {{ snackbar.text }}
            <v-btn dark text @click.stop="snackbarClose">Tutup</v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>
import { baseMixins } from '@module/document/mixins/BaseMixins';

export default {
    name: 'document-base',

    mixins: [baseMixins]
};
</script>

<style lang="sass">
    @import '@sass/backdrop.sass'
    @import '@sass/dataTable.sass'
    @import '@sass/page.sass'
    @import '@sass/toolbar.sass'
</style>