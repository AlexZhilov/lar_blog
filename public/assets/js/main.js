(()=>{"use strict";var e,a={319:()=>{!function(e){e(window).on("load",(function(){if(e(".loader").fadeOut(),e("#preloder").delay(200).fadeOut("slow"),e(".featured__controls li").on("click",(function(){e(".featured__controls li").removeClass("active"),e(this).addClass("active")})),e(".featured__filter").length>0){var a=document.querySelector(".featured__filter");mixitup(a)}})),e(".set-bg").each((function(){var a=e(this).data("setbg");e(this).css("background-image","url("+a+")")})),e(".humberger__open").on("click",(function(){e(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper"),e(".humberger__menu__overlay").addClass("active"),e("body").addClass("over_hid")})),e(".humberger__menu__overlay").on("click",(function(){e(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper"),e(".humberger__menu__overlay").removeClass("active"),e("body").removeClass("over_hid")})),e(".mobile-menu").slicknav({prependTo:"#mobile-menu-wrap",allowParentLinks:!0}),e(".categories__slider").owlCarousel({loop:!0,margin:0,items:4,dots:!1,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"],animateOut:"fadeOut",animateIn:"fadeIn",smartSpeed:1200,autoHeight:!1,autoplay:!0,responsive:{0:{items:1},480:{items:2},768:{items:3},992:{items:4}}}),e(".hero__categories__all").on("click",(function(){e(".hero__categories ul").slideToggle(400)})),e(".latest-product__slider").owlCarousel({loop:!0,margin:0,items:1,dots:!1,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"],smartSpeed:1200,autoHeight:!1,autoplay:!0}),e(".product__discount__slider").owlCarousel({loop:!0,margin:0,items:3,dots:!0,smartSpeed:1200,autoHeight:!1,autoplay:!0,responsive:{320:{items:1},480:{items:2},768:{items:2},992:{items:3}}}),e(".product__details__pic__slider").owlCarousel({loop:!0,margin:20,items:4,dots:!0,smartSpeed:1200,autoHeight:!1,autoplay:!0});var a=e(".price-range"),r=e("#minamount"),t=e("#maxamount"),s=a.data("min"),i=a.data("max");a.slider({range:!0,min:s,max:i,values:[s,i],slide:function(e,a){r.val("$"+a.values[0]),t.val("$"+a.values[1])}}),r.val("$"+a.slider("values",0)),t.val("$"+a.slider("values",1)),e("select").niceSelect(),e(".product__details__pic__slider img").on("click",(function(){var a=e(this).data("imgbigurl");a!=e(".product__details__pic__item--large").attr("src")&&e(".product__details__pic__item--large").attr({src:a})}));var l=e(".pro-qty");l.prepend('<span class="dec qtybtn">-</span>'),l.append('<span class="inc qtybtn">+</span>'),l.on("click",".qtybtn",(function(){var a=e(this),r=a.parent().find("input").val();if(a.hasClass("inc"))var t=parseFloat(r)+1;else if(r>0)t=parseFloat(r)-1;else t=0;a.parent().find("input").val(t)}))}(jQuery)},803:()=>{},271:()=>{}},r={};function t(e){var s=r[e];if(void 0!==s)return s.exports;var i=r[e]={exports:{}};return a[e](i,i.exports,t),i.exports}t.m=a,e=[],t.O=(a,r,s,i)=>{if(!r){var l=1/0;for(_=0;_<e.length;_++){for(var[r,s,i]=e[_],n=!0,o=0;o<r.length;o++)(!1&i||l>=i)&&Object.keys(t.O).every((e=>t.O[e](r[o])))?r.splice(o--,1):(n=!1,i<l&&(l=i));if(n){e.splice(_--,1);var u=s();void 0!==u&&(a=u)}}return a}i=i||0;for(var _=e.length;_>0&&e[_-1][2]>i;_--)e[_]=e[_-1];e[_]=[r,s,i]},t.o=(e,a)=>Object.prototype.hasOwnProperty.call(e,a),(()=>{var e={548:0,816:0,261:0};t.O.j=a=>0===e[a];var a=(a,r)=>{var s,i,[l,n,o]=r,u=0;if(l.some((a=>0!==e[a]))){for(s in n)t.o(n,s)&&(t.m[s]=n[s]);if(o)var _=o(t)}for(a&&a(r);u<l.length;u++)i=l[u],t.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return t.O(_)},r=self.webpackChunk=self.webpackChunk||[];r.forEach(a.bind(null,0)),r.push=a.bind(null,r.push.bind(r))})(),t.O(void 0,[816,261],(()=>t(319))),t.O(void 0,[816,261],(()=>t(803)));var s=t.O(void 0,[816,261],(()=>t(271)));s=t.O(s)})();
//# sourceMappingURL=main.js.map