(window.vcvWebpackJsonp4x=window.vcvWebpackJsonp4x||[]).push([[0],{"./node_modules/raw-loader/index.js!./portoHeaderSearchform/cssMixins/searchForm.pcss":function(e,r){e.exports="@if ($toggleSize != false || $toggleColor != false) {\r\n\t#header.header-builder .searchform button,\r\n\t#header.header-builder .searchform-popup .search-toggle {\r\n\t\t@if $toggleSize != false {\r\n\t\t\tfont-size: $(toggleSize);\r\n\t\t}\r\n\t\t@if $toggleColor != false {\r\n\t\t\tcolor: $(toggleColor);\r\n\t\t}\r\n\t}\r\n}\r\n\r\n@if $toggleHoverColor != false {\r\n\t#header.header-builder .searchform button:hover,\r\n\t#header.header-builder .searchform-popup .search-toggle:hover {\r\n\t\tcolor: $(toggleHoverColor);\r\n\t}\r\n}\r\n\r\n@if $inputSize != false {\r\n\t#header.header-builder .searchform input, #header.header-builder .searchform.searchform-cats input {\r\n\t\twidth: $(inputSize);\r\n\t}\r\n}\r\n\r\n@if $height != false {\r\n\t#header.header-builder .searchform input, #header.header-builder .searchform select, #header.header-builder .searchform .selectric .label, #header.header-builder .searchform button {\r\n\t\theight: $(height);line-height: $(height);\r\n\t}\r\n}\r\n\r\n@if ($borderWidth != false || $borderColor != false) {\r\n\t#header.header-builder .searchform {\r\n\t\t@if $borderWidth != false {\r\n\t\t\tborder-width: $(borderWidth)px;\r\n\t\t}\r\n\t\t@if $borderColor != false {\r\n\t\t\tborder-color: $(borderColor);\r\n\t\t}\r\n\t}\r\n\r\n\t@if $borderColor != false {\r\n\t\t#header.header-builder .searchform-popup .search-toggle:after {\r\n\t\t\tborder-bottom-color: $(borderColor);\r\n\t\t}\r\n\t}\r\n}\r\n\r\n@if $borderRadius != false {\r\n\t#header.header-builder .searchform { border-radius: $(borderRadius); }\r\n\t#header.header-builder .searchform input { border-radius: $(borderRadius) 0 0 $(borderRadius); }\r\n\t#header.header-builder .searchform button { border-radius: 0 $(borderRadius) $(borderRadius) 0; }\r\n\t.rtl #header .searchform input { border-radius: 0 $(borderRadius) $(borderRadius) 0; }\r\n\t.rtl #header .searchform button { border-radius: $(borderRadius) 0 0 $(borderRadius); }\r\n}\r\n\r\n@if $dividerColor != false {\r\n\t#header.header-builder .searchform input, #header.header-builder .searchform select, #header.header-builder .searchform .selectric, #header.header-builder .searchform .selectric-hover .selectric, #header.header-builder .searchform .selectric-open .selectric, #header.header-builder .searchform .autocomplete-suggestions, #header.header-builder .searchform .selectric-items {\r\n\t\tborder-color: $(dividerColor);\r\n\t}\r\n}"},"./portoHeaderSearchform/index.js":function(e,r,o){"use strict";o.r(r);var t=o("./node_modules/vc-cake/index.js"),a=o.n(t),i=o("./node_modules/@babel/runtime/helpers/extends.js"),s=o.n(i),l=o("./node_modules/@babel/runtime/helpers/classCallCheck.js"),n=o.n(l),c=o("./node_modules/@babel/runtime/helpers/createClass.js"),d=o.n(c),p=o("./node_modules/@babel/runtime/helpers/get.js"),h=o.n(p),u=o("./node_modules/@babel/runtime/helpers/inherits.js"),b=o.n(u),f=o("./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js"),m=o.n(f),g=o("./node_modules/@babel/runtime/helpers/getPrototypeOf.js"),_=o.n(g),v=o("./node_modules/react/index.js"),y=o.n(v);function x(e){var r=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,t=_()(e);if(r){var a=_()(this).constructor;o=Reflect.construct(t,arguments,a)}else o=t.apply(this,arguments);return m()(this,o)}}var S=function(e){b()(o,e);var r=x(o);function o(e){return n()(this,o),r.call(this,e)}return d()(o,[{key:"componentDidMount",value:function(){var e=this.props.atts;h()(_()(o.prototype),"updateShortcodeToHtml",this).call(this,this.getHBSearchformShortcode(e.placeholder_text,e.category_filter,e.category_filter_mobile,e.popup_pos),this.ref)}},{key:"componentDidUpdate",value:function(e,r){var t=this.props.atts,a=this.getHBSearchformShortcode(t.placeholder_text,t.category_filter,t.category_filter_mobile,t.popup_pos);a!==this.getHBSearchformShortcode(e.atts.placeholder_text,e.atts.category_filter,e.atts.category_filter_mobile,e.atts.popup_pos)&&h()(_()(o.prototype),"updateShortcodeToHtml",this).call(this,a,this.ref)}},{key:"shouldComponentUpdate",value:function(e,r){return!0}},{key:"getHBSearchformShortcode",value:function(e,r,o,t){return r||(r=""),o||(o=""),'[porto_hb_search_form placeholder_text="'.concat(e,'" category_filter="').concat(r,'" category_filter_mobile="').concat(o,'" popup_pos="').concat(t,'"]')}},{key:"render",value:function(){var e=this,r=this.props,o=r.id,t=r.editor,a=r.atts,i=this.applyDO("all"),l=a.placeholder_text,n=a.category_filter,c=a.category_filter_mobile,d=a.popup_pos,p=a.el_class;return y.a.createElement("div",s()({className:"vce-porto-hb-search-form"+(p?" "+p:"")},t,{id:"el-"+o},i),y.a.createElement("div",{className:"porto-hb-search-form vcvhelper",ref:function(r){e.ref=r},"data-vcvs-html":this.getHBSearchformShortcode(l,n,c,d)}))}}]),o}(Object(t.getService)("portoComponent").shortcodeComponent);(0,a.a.getService("cook").add)(o("./portoHeaderSearchform/settings.json"),(function(e){e.add(S)}),{css:!1,editorCss:!1,mixins:{searchForm:{mixin:o("./node_modules/raw-loader/index.js!./portoHeaderSearchform/cssMixins/searchForm.pcss")}}})},"./portoHeaderSearchform/settings.json":function(e){e.exports=JSON.parse('{"placeholder_text":{"type":"string","access":"public","value":"","options":{"label":"Placeholder Text"}},"category_filter":{"type":"toggle","access":"public","value":false,"options":{"label":"Show category filter"}},"category_filter_mobile":{"type":"toggle","access":"public","value":false,"options":{"label":"Show Categories on Mobile","onChange":{"rules":{"category_filter":{"rule":"toggle"}},"actions":[{"action":"toggleVisibility"}]}}},"popup_pos":{"type":"dropdown","access":"public","value":"","options":{"label":"Popup Position","description":"This works for only \\"Popup 1\\" and \\"Popup 2\\" and \\"Form\\" search layout on mobile. You can change search layout using Porto -> Theme Options -> Header -> Search Form -> Search Layout.","values":[{"label":"Default","value":""},{"label":"Left","value":"left"},{"label":"Center","value":"center"},{"label":"Right","value":"right"}]}},"el_class":{"type":"string","access":"public","value":"","options":{"label":"Extra class name","description":"Add an extra class name to the element and refer to it from Custom CSS option."}},"toggle_size":{"type":"string","access":"public","value":"","options":{"label":"Search Icon Size","cssMixin":{"mixin":"searchForm","property":"toggleSize","namePattern":"[\\\\da-f]+"}}},"toggle_color":{"type":"color","access":"public","value":"","options":{"label":"Search Icon Color","cssMixin":{"mixin":"searchForm","property":"toggleColor","namePattern":"[\\\\da-f]+"}}},"toggle_hover_color":{"type":"color","access":"public","value":"","options":{"label":"Search Icon Hover Color","cssMixin":{"mixin":"searchForm","property":"toggleHoverColor","namePattern":"[\\\\da-f]+"}}},"input_size":{"type":"string","access":"public","value":"","options":{"label":"Input Box Width","cssMixin":{"mixin":"searchForm","property":"inputSize","namePattern":"[\\\\da-f]+"}}},"height":{"type":"string","access":"public","value":"","options":{"label":"Height","cssMixin":{"mixin":"searchForm","property":"height","namePattern":"[\\\\da-f]+"}}},"border_width":{"type":"number","access":"public","value":"1","options":{"label":"Border Width (px)","min":0,"max":16,"cssMixin":{"mixin":"searchForm","property":"borderWidth","namePattern":"[\\\\da-f]+"}}},"border_color":{"type":"color","access":"public","value":"","options":{"label":"Border Color","cssMixin":{"mixin":"searchForm","property":"borderColor","namePattern":"[\\\\da-f]+"}}},"border_radius":{"type":"string","access":"public","value":"","options":{"label":"Border Radius","cssMixin":{"mixin":"searchForm","property":"borderRadius","namePattern":"[\\\\da-f]+"}}},"divider_color":{"type":"color","access":"public","value":"","options":{"label":"Divider Color","cssMixin":{"mixin":"searchForm","property":"dividerColor","namePattern":"[\\\\da-f]+"}}},"designOptions":{"type":"designOptions","access":"public","value":{},"options":{"label":"Design Options"}},"editFormTab1":{"type":"group","access":"protected","value":["placeholder_text","category_filter","category_filter_mobile","popup_pos","el_class"],"options":{"label":"Search Form Layout"}},"editFormTab2":{"type":"group","access":"protected","value":["toggle_size","toggle_color","toggle_hover_color","input_size","height","border_width","border_color","border_radius","divider_color"],"options":{"label":"Search Form Style"}},"metaEditFormTabs":{"type":"group","access":"protected","value":["editFormTab1","editFormTab2","designOptions"]},"relatedTo":{"type":"group","access":"protected","value":["General"]},"tag":{"access":"protected","type":"string","value":"portoHeaderSearchform"}}')}},[["./portoHeaderSearchform/index.js"]]]);