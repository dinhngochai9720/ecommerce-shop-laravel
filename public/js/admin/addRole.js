$(function () {
    $(".checkbox_all_one").on("click", function () {
        //click checkbox_all_one (checkbox parent) -> choose all checkboxes children
        $(this)
            .parents(".card") //find parent have class='card'
            .find(".checkbox_one")
            .prop("checked", $(this).prop("checked"));
    });

    $(".checkbox_all").on("click", function () {
        //click checkbox_all_one (checkbox parent) -> choose all checkboxes children
        $(this)
            .parents()
            .find(".checkbox_one")
            .prop("checked", $(this).prop("checked"));

        $(this)
            .parents()
            .find(".checkbox_all_one")
            .prop("checked", $(this).prop("checked"));
    });
});
