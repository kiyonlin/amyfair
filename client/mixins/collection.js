import qs from "qs"
import swal from "sweetalert2";
export default {
    data() {
        return {
            items: [],
            query: {},
            searched: false,
            currentPage: 1,
            perPage: 10,
            perPageOptions: [10, 15, 20, 50, 100],
            total: 0,
            allSelected: false,
            checkedItems: [],
            showModal: false,
            currentItemId: null,
            isEdit: false
        }
    },
    methods: {
        async itemsProvider(ctx) {
            let { url, query } = this.getUrl(ctx);
            let { data, meta } = await this.$axios.$get(url);
            this.total = meta.total;
            this.items = data;
            this.$router.push({ query });
            return data;
        },
        getUrl(ctx) {
            delete ctx.apiUrl;
            delete ctx.filter;
            let url = this.path;
            let query = Object.assign({}, ctx);
            if (this.searched) {
                query = Object.assign(query, this.query);
            }
            let querystring = qs.stringify(query);
            if (querystring) {
                url += `?${querystring}`;
            }
            return { url, query };
        },
        toggleSelectAll() {
            this.checkedItems = this.allSelected ? [] : this.items;
        },
        clearSelected() {
            this.allSelected = false;
            this.checkedItems = [];
        },
        showDetail(item, index, button) {
            this.isEdit = true;
            this.showModal = true;
            this.currentItemId = item.id;
        },
        add() {
            this.isEdit = false;
            this.showModal = true;
        },
        refresh() {
            this.$refs.table.refresh();
        },
        search() {
            this.searched = true;
            this.refresh();
        },
        reset() {
            this.searched = false;
            this.query = {};
            this.refresh();
        },
        async remove(item, index, ids = []) {
            let result = await swal({
                title: "确定删除吗?",
                text: "数据删除后将无法恢复!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定删除!",
                cancelButtonText: "取消",
                reverseButtons: true
            });

            if (result.value) {
                let id = ids[0] || item.id;
                this.$axios.$delete(`${this.path}/${id}`, { data: { ids } }).then(() => {
                    swal({
                        title: "删除成功!",
                        text: "数据已删除",
                        type: "success",
                        timer: 1500
                    });
                    this.$refs.table.refresh();
                    // 批量删除时清除选择的项
                    if (ids) this.clearSelected();
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal({ title: "取消", text: "删除已取消", type: "error", timer: 1000 });
            }
        },
        batchRemove() {
            if (!this.checkedItems.length) {
                swal({
                    text: "未选择项目",
                    type: "warning",
                    timer: 1000
                });
                return;
            }
            let ids = this.checkedItems.map(item => item.id);
            this.remove(null, null, ids);
        }
    },
    watch: {
        checkedItems(a, b) {
            this.allSelected = this.items.length === a.length ? true : false;
        },
        perPage(a, b) {
            if (a !== b) {
                this.clearSelected();
            }
        },
        currentPage(a, b) {
            if (a !== b) {
                this.clearSelected();
            }
        },
        filter(a, b) {
            if (a !== b) {
                this.clearSelected();
            }
        },
        async (a, b) {
            if (a !== b) {
                this.clearSelected();
            }
        }
    }
}
