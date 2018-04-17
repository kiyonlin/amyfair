<template>
  <div>
    <b-container class="my-2">
      <b-row>
        <b-col md="2">
          <b-btn-group>
            <b-btn @click="add"><fa icon="plus"/></b-btn>
            <b-btn @click="refresh"><fa icon="sync"/></b-btn>
            <b-btn @click="batchRemove"><fa icon="trash"/></b-btn>
          </b-btn-group>
        </b-col>
        <b-col md="1" class="ml-md-auto text-md-right my-1">
          <b-btn v-b-toggle.collapseSearch>筛选</b-btn>
        </b-col>
      </b-row>
    </b-container>
    <b-collapse id="collapseSearch" class="my-2">
      <b-card>
        <b-row class="mt-2">
          <b-col md="3">
            <b-form-group label="名称" label-for="name">
              <b-form-input id="name" v-model="query.name"></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="mt-2">
          <b-col md="4" class="ml-auto text-right">
              <b-btn @click="search" class="mr-1"><fa icon="search"/></b-btn>
              <b-btn @click="reset">{{ $t('btn.reset') }}</b-btn>
          </b-col>
        </b-row>
      </b-card>
    </b-collapse>
    <b-table width="100%" ref="table" show-empty empty-text="暂无数据" stacked="sm"
      :items="itemsProvider" :fields="fields"
      :currentPage="currentPage" :per-page="perPage">
      <template slot="HEAD_select" slot-scope="data">
        <b-form-checkbox type="checkbox" @click.native.stop="toggleSelectAll" v-model="allSelected"/>
      </template>
      <template slot="select" slot-scope="row">
        <b-form-checkbox type="checkbox" name="checked" :key="row.index" @click.stop :value="row.item" v-model="checkedItems"/>
      </template>
      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="showDetail(row.item, row.index, $event.target)" class="mt-1">
          详情
        </b-button>
        <b-button size="sm" variant="danger" @click.stop="remove(row.item, row.index)" class="mt-1">
          删除
        </b-button>
      </template>
    </b-table>
    
    <pagination :total="total" :per-page.sync="perPage" :current-page.sync="currentPage" :per-page-options="perPageOptions"></pagination>

    <form-dialog :item-id.sync="currentItemId" :show.sync="showModal" :is-edit="isEdit" :path="path" @created="refresh"></form-dialog>
  </div>
</template>

<script>
import formDialog from "./form";
import Pagination from "~/components/global/Pagination";
import collection from "~/mixins/collection";
export default {
  layout: "admin",
  head() {
    return {
      titleTemplate: `%s - 展会管理`
    };
  },
  components: { formDialog, Pagination },
  mixins: [collection],
  data() {
    return {
      path: "admin/exhibitions",
      fields: [
        { key: "select", label: "select all" },
        { key: "name", label: "名称" },
        { key: "address", label: "地址" },
        { key: "main_products", label: "主要产品" },
        { key: "start_at", label: "开始时间" },
        { key: "end_at", label: "结束时间" },
        { key: "created_at", label: "创建时间" },
        { key: "actions", label: "操作" }
      ]
    };
  }
};
</script>