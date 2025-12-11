function goToByScroll(id="") {
    $('html,body').animate({
        scrollTop: ($(id).offset().top - 70)
    }, 500);
}

// PHƯƠNG THỨC LOAD KẾT QUẢ 
function loadPage(element="", page="", id_list="", id_cat="", loai="") {
    $.ajax({
        type: "POST",
        url: "ajax/ajax_page.php",
        data: { id_list: id_list, page: page, id_cat: id_cat, loai: loai },
        success: function(msg) {
            $(element).html(msg);
            $(element + ' .pagination li.active').click(function(event) {
                var page = $(this).attr('p');
                goToByScroll(element);
                loadPage(element, page, id_list, id_cat, loai);
            });
        }
    });
}