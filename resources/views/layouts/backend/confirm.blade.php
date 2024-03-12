<script>
    $(document).on('click', '.btn-confirm', function (e) {
        e.preventDefault()
        const url = $(this).data('url')
        const title = $(this).data('title');
        Swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Xác nhận",
        }).then((result) => {
            if (result.isConfirmed) {
                    window.location = url
            }
        })
    })
</script>
