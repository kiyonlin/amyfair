webpackJsonp([1],{"2VkU":function(t,n,a){"use strict";n.a={}},"56XK":function(t,n,a){var i=a("lSFy");"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);a("rjj0")("3cdf8414",i,!1,{sourceMap:!1})},CAvD:function(t,n,a){"use strict";var i=a("wuBo"),r=a("IRLx");n.a={middleware:"admin-auth",head:function(){return{title:"管理后台"}},components:{Navbar:i.a,Sidebar:r.a}}},CHoz:function(t,n,a){"use strict";var i=function(){var t=this.$createElement,n=this._self._c||t;return n("div",[n("b-list-group",[n("b-list-group-item",{attrs:{variant:"light",to:"/admin/dashboard"}},[this._v("后台管理")]),n("b-list-group-item",{attrs:{variant:"light",to:"/admin/invitation"}},[this._v("邀请申请")]),n("b-list-group-item",{attrs:{variant:"light",to:"/admin/setting"}},[this._v("设置")])],1)],1)};i._withStripped=!0;var r={render:i,staticRenderFns:[]};n.a=r},EgO0:function(t,n,a){var i=a("yK29");"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);a("rjj0")("75a763a0",i,!1,{sourceMap:!1})},IMIe:function(t,n,a){"use strict";var i=a("Xxa5"),r=a.n(i),e=a("exGp"),s=a.n(e),o=a("Dd8w"),c=a.n(o),u=a("NYxO");n.a={data:function(){return{notifications:[{id:"1",text:"notification1",path:"/admin/dashboard"},{id:"2",text:"notification2",path:"/admin/dashboard"}]}},computed:c()({},Object(u.mapGetters)({user:"auth/user"}),{notificationCount:function(){return this.notifications.length}}),methods:{logout:function(){var t=s()(r.a.mark(function t(){return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,this.$store.dispatch("auth/logout");case 2:this.$router.push({path:this.$i18n.path("")});case 3:case"end":return t.stop()}},t,this)}));return function(){return t.apply(this,arguments)}}()}}},IRLx:function(t,n,a){"use strict";var i=a("2VkU"),r=a("CHoz"),e=!1;var s=function(t){e||a("Sz8W")},o=a("VU/8")(i.a,r.a,!1,s,null,null);o.options.__file="client/components/admin/Sidebar.vue",n.a=o.exports},K9E8:function(t,n,a){"use strict";var i=function(){var t=this,n=t.$createElement,a=t._self._c||n;return a("div",[a("b-container",{staticClass:"pl-0 pr-0",attrs:{fluid:""}},[a("b-navbar",{staticClass:"px-md-2 px-lg-5 px-xl-5",attrs:{toggleable:"sm",type:"light",variant:"light"}},[a("b-navbar-toggle",{attrs:{target:"nav_collapse"}}),a("b-navbar-brand",{staticClass:"ml-md-5 pl-md-5",attrs:{to:t.$i18n.path(""),exact:""}},[t._v("首页")]),a("b-collapse",{staticClass:"mr-lg-5",attrs:{"is-nav":"",id:"nav_collapse"}},[a("b-navbar-nav",{staticClass:"ml-auto"},[a("b-nav-item-dropdown",{attrs:{right:"","no-caret":""}},[a("template",{slot:"button-content"},[a("fa",{attrs:{icon:"bell"}}),t.notificationCount?a("b-badge",{attrs:{variant:"danger",pill:""}},[t._v("\n                "+t._s(t.notificationCount)+"\n              ")]):t._e()],1),t._l(t.notifications,function(n){return a("b-dropdown-item",{key:n.id,attrs:{href:n.path}},[t._v("\n              "+t._s(n.text)+"\n            ")])})],2),t.user?a("b-nav-item-dropdown",{attrs:{right:""}},[a("template",{slot:"button-content"},[a("fa",{attrs:{icon:"user"}}),t._v("\n              "+t._s(t.user.email)+"\n            ")],1),a("b-dropdown-item",{attrs:{to:"/admin/setting"}},[a("fa",{attrs:{icon:"cog"}}),t._v("\n              "+t._s(t.$t("links.setting"))+"\n            ")],1),a("b-dropdown-item",{on:{click:function(n){return n.preventDefault(),t.logout(n)}}},[a("fa",{attrs:{icon:"sign-out-alt"}}),t._v("\n              "+t._s(t.$t("links.logout"))+"\n            ")],1)],2):t._e()],1)],1)],1)],1)],1)};i._withStripped=!0;var r={render:i,staticRenderFns:[]};n.a=r},Sz8W:function(t,n,a){var i=a("bLF3");"string"==typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);a("rjj0")("2adbae5c",i,!1,{sourceMap:!1})},bLF3:function(t,n,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},cLcP:function(t,n,a){"use strict";Object.defineProperty(n,"__esModule",{value:!0});var i=a("CAvD"),r=a("z+Nz"),e=!1;var s=function(t){e||a("56XK")},o=a("VU/8")(i.a,r.a,!1,s,null,null);o.options.__file="client/layouts/admin.vue",n.default=o.exports},lSFy:function(t,n,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},wuBo:function(t,n,a){"use strict";var i=a("IMIe"),r=a("K9E8"),e=!1;var s=function(t){e||a("EgO0")},o=a("VU/8")(i.a,r.a,!1,s,null,null);o.options.__file="client/components/admin/Navbar.vue",n.a=o.exports},yK29:function(t,n,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},"z+Nz":function(t,n,a){"use strict";var i=function(){var t=this.$createElement,n=this._self._c||t;return n("div",[n("navbar"),n("b-container",[n("b-row",{staticClass:"mt-3"},[n("b-col",{attrs:{lg:"2",md:"3"}},[n("sidebar")],1),n("b-col",{attrs:{lg:"10",md:"9"}},[n("nuxt")],1)],1)],1)],1)};i._withStripped=!0;var r={render:i,staticRenderFns:[]};n.a=r}});