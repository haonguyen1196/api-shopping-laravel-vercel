function actionDelete(e) {
  e.preventDefault()
  let urlRequest = e.target.dataset.url;
  Swal.fire({
      title: 'Bạn muốn xóa?',
      text: "Bạn sẽ không thể khôi phục dữ liệu",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: urlRequest,
          success: function (data) {
              if(data.code === 200) {
                  e.target.parentElement.parentElement.remove();
                  Swal.fire(
                      'Đã xóa',
                      'Tệp của bạn đã được xóa.',
                      'success'
                    )
              }
          },
          error: function (data) {
              console(data)
          }
        })
      }
    })
}



const deleteBtn = $('.active_delete');
deleteBtn.click((e) => actionDelete(e));