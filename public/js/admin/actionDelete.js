const actionDelete = function (event) {
    event.preventDefault();

    //get router of each delete button in view list product
    let urlRequest = $(this).data("url");
    // alert(urlRequest);

    //get delete button
    let that = $(this);

    Swal.fire({
        title: "Xóa",
        text: "Bạn có chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                success: function (data) {
                    // console.log(data);
                    if (data.code == 200) {
                        //parent().parent() //gọi đến lớp cha thứ 2 của delete button để xóa cả dòng td trong table
                        that.parent().parent().remove(); //Remove record in view product.index

                        if (result.isConfirmed) {
                            Swal.fire("Đã xóa!", "Thành công.", "success");
                        }
                    }
                },
                error: function () {},
            });
        }
    });
};

$(function () {
    $(document).on("click", ".action-delete", actionDelete);
});
