<template>
    <v-page-wrap>

    </v-page-wrap>
</template>

<script>
import { pageMixins } from '@module/document/mixins/PageMixins';

export default {
    name: 'document-home',

    mixins: [pageMixins],

    created() {
        this.initPage({
            icon: 'dashboard',
            title: 'Beranda',
        });

        this.setToolbar({
            noCrud: true
        });
    },
};
</script>