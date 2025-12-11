/* Validation form */
ValidationFormSelf("validation-newsletter");
ValidationFormSelf("validation-cart");
ValidationFormSelf("validation-user");
ValidationFormSelf("validation-contact");

/* Exists */
$.fn.exists = function() {
    return this.length;
};
// search in-out

$(document).ready(function() {
    var show = 0;
    $('a.search-inOut').click(function() {
        if (show == 1) {
            $('.form-row-search').css({ 'width': 0 });
            $('.search-form').css({ 'width': 0, 'opacity': 0 });
            $('a.search-inOut').removeClass('active');
            show = 0;
            execSearch();
        } else {
            $('.form-row-search').css({ 'width': '100%' });
            if ($(window).width() <= 1100) {
                $('.search-form').css({ 'width': 270, 'opacity': 1 });
            } else {
                $('.search-form').css({ 'width': 200, 'opacity': 1 });
            }
            $('a.search-inOut').addClass('active');
            document.getElementById("frm_search").reset();
            show = 1;
        }
    });
    $('#keyword').keydown(function(e) {
        if (e.keyCode == 13) {
            execSearch();
        }
    });
    $("#form-timkiem").submit(function(event) {
        event.preventDefault();
        window.location = 'tim-kiem?keyword=' + $(".txt_keywords").val();
    });
});
$(function() {
    $(' #tnSearch_rp').click(function(evt) {
        onSearch_rp(evt);
    });
});

function onSearch_rp(evt) {
    var keyword_rp = document.frm_search_rp.keyword_rp;
    if (keyword_rp.value == '' || keyword_rp.value === 'Nhập từ khóa...') {
        alert('Bạn chưa nhập từ khóa');
        keyword_rp.focus();
        return false;
    }
    location.href = 'tim-kiem?keyword=' + keyword_rp.value;
}

function doEnter_rp(evt) {
    var key;
    if (evt.keyCode == 13 || evt.which == 13) {
        onSearch_rp(evt);
    } else {
        return false;
    }
}
//slide
NN_FRAMEWORK.Swiper = function() {
    if ($(".slide-swiper").exists()) {
        var mySwiper = new Swiper('.slide-swiper', {
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            effect: 'fade',
            keyboard: true,
            // direction: 'vertical',
            loop: true,
            // spaceBetween: 30,
            autoplay: {
                delay: 3500,
            },
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: false,
                clickable: true,
            },
            navigation: {
                nextEl: '.slide-button-next',
                prevEl: '.slide-button-prev',
            },
            // breakpoints: {
            //     640: {slidesPerView: 2, },
            //     768: {slidesPerView: 4,  },
            //     1024: {slidesPerView: 5, },
            // }
        })
    }
    if ($(".ads-swiper").exists()) {
        var mySwiper = new Swiper('.ads-swiper', {
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            // effect: 'fade',
            keyboard: true,
            loop: true,
            autoplay: {
                delay: 3500,
            },
        })
    }
    if ($(".ptop-swiper").exists()) {
        var mySwiper = new Swiper('.ptop-swiper', {
            slidesPerView: 4,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            keyboard: true,
            // direction: 'vertical',
            loop: true,
            spaceBetween: 20,
            autoplay: {
                delay: 3500,
            },
            // navigation: {
            //     nextEl: '.brand-button-next',
            //     prevEl: '.brand-button-prev',
            // },
            breakpoints: {
                300: { slidesPerView: 2, },
                580: { slidesPerView: 2, },
                768: { slidesPerView: 3, },
                992: { slidesPerView: 4, },
                1200: { slidesPerView: 4, },
            }
        })
    }
    if ($(".news-swiper").exists()) {
        var mySwiper = new Swiper('.news-swiper', {
            slidesPerView: 3,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            keyboard: true,
            // direction: 'vertical',
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 3500,
            },
            // navigation: {
            //     nextEl: '.partner-button-next',
            //     prevEl: '.partner-button-prev',
            // },
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 10, },
                300: { slidesPerView: 1, spaceBetween: 10, },
                580: { slidesPerView: 2, spaceBetween: 10, },
                768: { slidesPerView: 2, spaceBetween: 10, },
                992: { slidesPerView: 3, spaceBetween: 10, },
                1200: { slidesPerView: 3, },
            }
        })
    }
    if ($(".video-swiper").exists()) {
        var mySwiper = new Swiper('.video-swiper', {
            slidesPerView: 3,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            keyboard: true,
            // direction: 'vertical',
            loop: true,
            // spaceBetween: 30,
            autoplay: {
                delay: 3500,
            },
            // breakpoints: {
            //     640: {slidesPerView: 2, },
            //     768: {slidesPerView: 4,  },
            //     1024: {slidesPerView: 5, },
            // }
        })
    }
    if ($(".inProduct-swiper").exists()) {
        var mySwiper = new Swiper('.inProduct-swiper', {
            slidesPerView: 4,
            slidesPerColumn: 1,
            slidesPerGroup: 1,
            lazy: true,
            keyboard: true,
            // direction: 'vertical',
            loop: true,
            spaceBetween: 10,
            autoplay: {
                delay: 3500,
            },
            navigation: {
                nextEl: '.inProduct-button-next',
                prevEl: '.inProduct-button-prev',
            },
            // breakpoints: {
            //     640: {slidesPerView: 2, },
            //     768: {slidesPerView: 4,  },
            //     1024: {slidesPerView: 5, },
            // }
        })
    }
}

// script ajax tab
$(window).load(function() {
    $('.introduce-item').click(function() {
        var id = $(this).data("id")
        $(".introduce-result").load("ajax/ajax_tab_introduce.php", "&id=" + id, function() {});
        $(this).parent().find('div').removeClass("tab-active");
        $(this).addClass("tab-active");
        return false;
    });
});

// $(window).load(function() {
//     $('.tab-title li').click(function() {
//         var idl = $(this).data("idl")
//         var type = $(this).data("type")
//         var table = $(this).data("table")
//         var thumb = $(this).data("thumb")
//         var limit = $(this).data("limit")
//         $("#tab-show-" + type).load("ajax/ajax_tab.php", "&idl=" + idl + "&type=" + type + "&table=" + table + "&limit=" + limit + "&thumb=" + thumb, function() {});
//         $(this).parent().find('li').removeClass("tab-active");
//         $(this).addClass("tab-active");
//         return false;
//     });
// });

// script ajax tab list
// $(window).load(function() {
//     $('.tab-title li').click(function() {
//         var idl = $(this).data("idl")
//         var idc = $(this).data("idc")
//         var type = $(this).data("type")
//         var table = $(this).data("table")
//         var thumb = $(this).data("thumb")
//         var limit = $(this).data("limit")
//         $("#tab-show-" + type + '-' + idl).load("ajax/ajax_tab_list.php", "&idl=" + idl + "&idc=" + idc + "&type=" + type + "&table=" + table + "&limit=" + limit + "&thumb=" + thumb, function() {});
//         $(this).parent().find('li').removeClass("tab-active");
//         $(this).addClass("tab-active");
//         return false;
//     });
// });


/* Simply scroll */
NN_FRAMEWORK.SimplyScroll = function() {
    if ($(".news-scroll ul").exists()) {
        $(".news-scroll ul").simplyScroll({
            customClass: 'vert',
            orientation: 'vertical',
            // orientation: 'horizontal',
            auto: true,
            manualMode: 'auto',
            pauseOnHover: 1,
            speed: 1,
            loop: 0
        });
    }
};

/* Owl video*/

$(document).ready(function() {
    $(".video-item a").click(function(event) {
        $("#video-player").attr('src', 'https://www.youtube.com/embed/' + $(this).attr('data-id'));
    });
});
$(".video-select").change(function(event) {
    $("#video-player").attr('src', 'https://www.youtube.com/embed/' + $(this).val());
});

/* Paging ajax */
if ($(".project-paging").exists()) {
    loadPagingAjax("ajax/ajax_page.php?table=news&type=project&perpage=4", '.project-paging');
}

/* Paging category ajax */
if ($(".pagelist-paging").exists()) {
    $(".pagelist-paging").each(function() {
        var list = $(this).data("list");
        loadPagingAjax("ajax/ajax_page.php?table=product&type=product&perpage=" + PAGE_PRODUCT + "&idList=" + list, '.pagelist-' + list);
    })
}

function execSearch() {
    var keyword = $('#keyword').val();
    var href_search = $('#href_search').val();
    var defaultvalue = $('#defaultvalue').val();
    if (keyword == defaultvalue)
        return false;
    if (keyword != '') {
        var url = href_search + '&keyword=' + encodeURIComponent(keyword)
        window.location = url;
        return false;
    }
}

/* Back to top */
NN_FRAMEWORK.BackToTop = function() {
    $(window).scroll(function() {
        if (!$('.scrollToTop').length) $("body").append('<div class="scrollToTop"><img src="' + GOTOP + '" alt="Go Top"/></div>');
        if ($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
        else $('.scrollToTop').fadeOut();
    });

    $('body').on("click", ".scrollToTop", function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });
};

/* Alt images */
NN_FRAMEWORK.AltImages = function() {
    $('img').each(function(index, element) {
        if (!$(this).attr('alt') || $(this).attr('alt') == '') {
            $(this).attr('alt', WEBSITE_NAME);
        }
    });
};

/* Fix menu */
NN_FRAMEWORK.FixMenu = function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() >= ($(".header-top").height() + $(".header-mid").height())) {
            $(".header-bot").addClass("menu-fixed");
            $('.header-mid').css({ 'margin-bottom': '50px' });
        } else {
            $(".header-bot").removeClass("menu-fixed");
            $('.header-mid').css({ 'margin-bottom': '0px' });
        }
    });
};

/* Tools */
NN_FRAMEWORK.Tools = function() {
    if ($(".toolbar").exists()) {
        $(".footer").css({ marginBottom: $(".toolbar").innerHeight() });
    }
};

/* Popup */
NN_FRAMEWORK.Popup = function() {
    if ($("#popup").exists()) {
        $('#popup').modal('show');
    }
};

/* Wow */
NN_FRAMEWORK.WowAnimation = function() {
    new WOW().init();
};

/* Mmenu */
NN_FRAMEWORK.Mmenu = function() {
    if ($("nav#menu").exists()) {
        $('nav#menu').mmenu();
    }
};

/* Toc */
NN_FRAMEWORK.Toc = function() {
    if ($(".toc-list").exists()) {
        $(".toc-list").toc({
            content: "div#toc-content",
            headings: "h2,h3,h4"
        });

        if (!$(".toc-list li").length) $(".meta-toc").hide();

        $('.toc-list').find('a').click(function() {
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
    }
};



/* Tabs */
NN_FRAMEWORK.Tabs = function() {
    if ($(".ul-tabs-pro-detail").exists()) {
        $(".ul-tabs-pro-detail li").click(function() {
            var tabs = $(this).data("tabs");
            $(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
            $(this).addClass("active");
            $("." + tabs).addClass("active");
        });
    }
};

/* Photobox */
NN_FRAMEWORK.Photobox = function() {
    if ($(".album-gallery").exists()) {
        $('.album-gallery').photobox('a', { thumbs: true, loop: false });
    }
};

/* Datetime picker */
NN_FRAMEWORK.DatetimePicker = function() {
    if ($('#ngaysinh').exists()) {
        $('#ngaysinh').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            formatDate: 'd/m/Y',
            minDate: '01/01/1950',
            maxDate: TIMENOW
        });
    }
};

/* Search */
NN_FRAMEWORK.Search = function() {
    if ($(".icon-search").exists()) {
        $(".icon-search").click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(".search-grid").stop(true, true).animate({ opacity: "0", width: "0px" }, 200);
            } else {
                $(this).addClass('active');
                $(".search-grid").stop(true, true).animate({ opacity: "1", width: "230px" }, 200);
            }
            document.getElementById($(this).next().find("input").attr('id')).focus();
            $('.icon-search i').toggleClass('fa fa-search fa fa-times');
        });
    }
};

// search in-out
$(document).ready(function() {
    var show = 0;
    $('a.search-inOut').click(function() {
        if (show == 1) {
            $('.form-row-search').css({ 'width': 0 });
            $('.search-form').css({ 'width': 0, 'opacity': 0 });
            $('a.search-inOut').removeClass('active');
            show = 0;
            execSearch();
        } else {
            $('.form-row-search').css({ 'width': '100%' });
            if ($(window).width() <= 1100) {
                $('.search-form').css({ 'width': 270, 'opacity': 1 });
            } else {
                $('.search-form').css({ 'width': 200, 'opacity': 1 });
            }
            $('a.search-inOut').addClass('active');
            document.getElementById("frm_search").reset();
            show = 1;
        }
    });
    $('#keyword').keydown(function(e) {
        if (e.keyCode == 13) {
            execSearch();
        }
    });
})

function execSearch() {
    var keyword = $('#keyword').val();
    var href_search = $('#href_search').val();
    var defaultvalue = $('#defaultvalue').val();
    if (keyword == defaultvalue)
        return false;
    if (keyword != '') {
        var url = href_search + '?keyword=' + encodeURIComponent(keyword)
        window.location = url;
        return false;
    }
}

/* Videos */
NN_FRAMEWORK.Videos = function() {
    if ($("#block-inVideo").exists()) {
        $('[data-fancybox="inVideo"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 800,
            animationEffect: "fade",
            animationDuration: 800,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false
        });
    }
    if ($(".inGallery-box").exists()) {
        $('[data-fancybox="inGallery"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 800,
            animationEffect: "fade",
            animationDuration: 800,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false
        });
    }
    if ($(".inCatalogue").exists()) {
        $('[data-fancybox="inCatalogue"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 600,
            animationEffect: "fade",
            animationDuration: 600,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false,
            width: 600,
            height: 300,
            type: 'iframe'
        });
    }

    if ($(".branch-col").exists()) {
        $('[data-fancybox="branch"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 600,
            animationEffect: "fade",
            animationDuration: 600,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false,
            width: 600,
            height: 300,
        });
    }

};
$(document).ready(function() {
    $('.fancybox').fancybox({
        transitionEffect: "fade",
        transitionDuration: 600,
        animationEffect: "fade",
        animationDuration: 600,
        arrows: true,
        infobar: false,
        toolbar: true,
        hash: false,
        hash: false,
        width: 700,
        height: 400,
    });
    $('.fancybox-popup').fancybox({
        transitionEffect: "fade",
        transitionDuration: 600,
        animationEffect: "fade",
        animationDuration: 600,
        arrows: true,
        infobar: false,
        toolbar: true,
        hash: false,
        hash: false,
        width: 500,
        height: 450,
    });
});

/* Owl pro detail */
NN_FRAMEWORK.OwlProDetail = function() {
    if ($(".owl-thumb-pro").exists()) {
        $('.owl-thumb-pro').owlCarousel({
            items: 4,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 10,
            smartSpeed: 250,
            nav: false,
            dots: false
        });
        $('.prev-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('prev.owl.carousel');
        });
        $('.next-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('next.owl.carousel');
        });
    }
};

/* Cart */
NN_FRAMEWORK.Cart = function() {
    $("body").on("click", ".addcart", function() {
        var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
        var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
        var id = $(this).data("id");
        var action = $(this).data("action");
        var quantity = ($(".qty-pro").val()) ? $(".qty-pro").val() : 1;

        if (id) {
            $.ajax({
                url: 'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: { cmd: 'add-cart', id: id, mau: mau, size: size, quantity: quantity },
                success: function(result) {
                    if (action == 'addnow') {
                        $('.count-cart').html(result.max);
                        $.ajax({
                            url: 'ajax/ajax_cart.php',
                            type: "POST",
                            dataType: 'html',
                            async: false,
                            data: { cmd: 'popup-cart' },
                            success: function(result) {
                                $("#popup-cart .modal-body").html(result);
                                $('#popup-cart').modal('show');
                            }
                        });
                    } else if (action == 'buynow') {
                        window.location = CONFIG_BASE + "gio-hang";
                    }
                }
            });
        }
    });

    $("body").on("click", ".del-procart", function() {
        if (confirm(LANG['delete_product_from_cart'])) {
            var code = $(this).data("code");
            var ship = $(".price-ship").val();

            $.ajax({
                type: "POST",
                url: 'ajax/ajax_cart.php',
                dataType: 'json',
                data: { cmd: 'delete-cart', code: code, ship: ship },
                success: function(result) {
                    $('.count-cart').html(result.max);
                    if (result.max) {
                        $('.price-temp').val(result.temp);
                        $('.load-price-temp').html(result.tempText);
                        $('.price-total').val(result.total);
                        $('.load-price-total').html(result.totalText);
                        $(".procart-" + code).remove();
                    } else {
                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>' + LANG['no_products_in_cart'] + '</p><span>' + LANG['back_to_home'] + '</span></a>');
                    }
                }
            });
        }
    });

    $("body").on("click", ".counter-procart", function() {
        var $button = $(this);
        var input = $button.parent().find("input");
        var id = input.data('pid');
        var code = input.data('code');
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") quantity = parseFloat(oldValue) + 1;
        else if (oldValue > 1) quantity = parseFloat(oldValue) - 1;
        $button.parent().find("input").val(quantity);
        update_cart(id, code, quantity);
    });

    $("body").on("change", "input.quantity-procat", function() {
        var quantity = $(this).val();
        var id = $(this).data("pid");
        var code = $(this).data("code");
        update_cart(id, code, quantity);
    });

    if ($(".select-city-cart").exists()) {
        $(".select-city-cart").change(function() {
            var id = $(this).val();
            load_district(id);
            load_ship();
        });
    }

    if ($(".select-district-cart").exists()) {
        $(".select-district-cart").change(function() {
            var id = $(this).val();
            load_wards(id);
            load_ship();
        });
    }

    if ($(".select-wards-cart").exists()) {
        $(".select-wards-cart").change(function() {
            var id = $(this).val();
            load_ship(id);
        });
    }

    if ($(".payments-label").exists()) {
        $(".payments-label").click(function() {
            var payments = $(this).data("payments");
            $(".payments-cart .payments-label, .payments-info").removeClass("active");
            $(this).addClass("active");
            $(".payments-info-" + payments).addClass("active");
        });
    }

    if ($(".color-pro-detail").exists()) {
        $(".color-pro-detail").click(function() {
            $(".color-pro-detail").removeClass("active");
            $(this).addClass("active");

            var id_mau = $("input[name=color-pro-detail]:checked").val();
            var idpro = $(this).data('idpro');

            $.ajax({
                url: 'ajax/ajax_color.php',
                type: "POST",
                dataType: 'html',
                data: { id_mau: id_mau, idpro: idpro },
                success: function(result) {
                    if (result != '') {
                        $('.left-pro-detail').html(result);
                        MagicZoom.refresh("Zoom-1");
                        NN_FRAMEWORK.OwlProDetail();
                    }
                }
            });
        });
    }

    if ($(".size-pro-detail").exists()) {
        $(".size-pro-detail").click(function() {
            $(".size-pro-detail").removeClass("active");
            $(this).addClass("active");
        });
    }

    if ($(".quantity-pro-detail span").exists()) {
        $(".quantity-pro-detail span").click(function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 1) var newVal = parseFloat(oldValue) - 1;
                else var newVal = 1;
            }
            $button.parent().find("input").val(newVal);
        });
    }
};



// effect run
$(window).bind("load resize", function() {
    var api = $(".effect-run").peShiner({
        api: true,
        paused: true,
        reverse: true,
        repeat: 1,
        color: 'white'
    });

    api.resume();
});
/* Ready */
$(document).ready(function() {
    NN_FRAMEWORK.Swiper();
    NN_FRAMEWORK.Tools();
    NN_FRAMEWORK.Popup();
    NN_FRAMEWORK.WowAnimation();
    NN_FRAMEWORK.AltImages();
    NN_FRAMEWORK.BackToTop();
    NN_FRAMEWORK.FixMenu();
    NN_FRAMEWORK.Mmenu();
    // NN_FRAMEWORK.OwlPage();
    // NN_FRAMEWORK.OwlProDetail();
    NN_FRAMEWORK.Toc();
    NN_FRAMEWORK.Cart();
    NN_FRAMEWORK.SimplyScroll();
    NN_FRAMEWORK.Tabs();
    NN_FRAMEWORK.Videos();
    NN_FRAMEWORK.Photobox();
    NN_FRAMEWORK.Search();
    NN_FRAMEWORK.DatetimePicker();
});