!function(e){var r={};function t(n){if(r[n])return r[n].exports;var o=r[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,t),o.l=!0,o.exports}t.m=e,t.c=r,t.d=function(e,r,n){t.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:n})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,r){if(1&r&&(e=t(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var o in e)t.d(n,o,function(r){return e[r]}.bind(null,o));return n},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},t.p="/",t(t.s=3)}({3:function(e,r,t){e.exports=t("aY7j")},aY7j:function(e,r){var t,n;$("#category").change((function(){$.getJSON("/knowledge-base/admin/category/"+$(this).val()+"/groups",(function(e){if(void 0===e.error){if(t)for(var r=0;r<t.length;r++)(n=$("input[type='checkbox'][name='groups[]'][value='"+t[r]+"']")).prop("checked",!1),n.prop("disabled",!1);t=e;for(var o=0;o<e.length;o++)(n=$("input[type='checkbox'][name='groups[]'][value='"+e[o]+"']")).prop("checked",!0),n.prop("disabled",!0)}}))}))}});