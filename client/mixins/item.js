export default {
    props: {
        show: {
            type: Boolean,
            required: true
        },
        itemId: {
            type: Number,
            default: null
        },
        isEdit: {
            type: Boolean,
            default: false
        },
        path: String
    },
    data() {
        return {
            visiable: false,
            form: {}
        };
    },
    watch: {
        show() {
            this.visiable = this.show;
            if (this.visiable) this.init();
        }
    },
    computed: {
        title() {
            return this.isEdit ? "查看" : "添加";
        }
    },
    methods: {
        async init() {
            if (this.isEdit && this.itemId) {
                let { data } = await this.$axios.get(
                    `${this.path}/${this.itemId}`
                );
                this.form = data.data;
            }
        },
        /**
         * 同步sync数据，根据Vue2.3以后的版本，因为是props属性，需要使用事件触发
         * 详见：https://cn.vuejs.org/v2/guide/components.html#sync-修饰符
         * 当关闭对话框时，更新父组件信息
         */
        reset() {
            this.visiable = false;
            this.form = {};
            this.$emit("update:show", false);
            this.$emit("update:itemId", null);
        }
    }
}
