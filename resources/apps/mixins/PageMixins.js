import { mapState, mapActions } from 'vuex';

export const pageMixins = {
    computed: {
        ...mapState(['combos', 'fineUploader', 'mobile', 'record', 'upload'])
    },

    methods: {
        ...mapActions(['initPage', 'setHeader', 'setPageURL', 'setRecord', 'setToolbar', 'setUploadCallback'])
    }
};