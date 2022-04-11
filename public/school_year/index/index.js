function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data("url");
    Swal.fire({
        title: "Bạn có chắc muốn xóa không?",
        text: "Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Không xóa",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Xong",
                text: "Bạn đã xóa thành công",
                icon: "success",
                showConfirmButton: false,
            });
            setTimeout(() => {
                window.location.href = `http://localhost:8000/school-year/delete/${urlRequest}`;
            }, 1000);
        }
    });
}

$(function () {
    $(document).on("click", ".action-delete", actionDelete);
});
