<script>
    $(function () {
        $("input[type = file]").on('change', function (e) {
            e.preventDefault();
            var input = e.target;
            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                var output = $('#image').attr('src', dataURL);
            }
            reader.readAsDataURL(input.files[0]);
        })
    })
</script>
