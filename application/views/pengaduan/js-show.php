<!-- jQuery Scrollbar -->
<script src="<?= base_url('assets/') ?>js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="<?= base_url('assets/') ?>js/plugin/datatables/datatables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugin/select2/select2.min.js"></script>
<script type="text/javascript">
	var table = $('#multi-filter-select').DataTable({
		"sDom": "ftipr",
		order: [[ 0, "asc" ]],
		language: {
			search: "Pencarian Data:",
			searchPlaceholder: "Kata pencarian",
		}
	});

	function searchData(column, val){
		table.columns(column).search(val ? val : '', true, false).draw();
	}

	function confirmRemove(element){
        var id = $(element).attr("data-id");
        var nama = $(element).attr("data-nama");
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Ingin menghapus data pengaduan dengan perihal \""+nama+"\"",
            showCancelButton: true,
            allowOutsideClick: false,
            cancelButtonColor: '#f25961',
            confirmButtonColor: '#31ce36',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',       
        }).then((result) => {
            if (result.value) {
                removeData(id);
            }
        });
    }

    function confirmUpdate(element){
        var id = $(element).attr("data-id");
        var nama = $(element).attr("data-nama");
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Pengaduan dengan perihal \""+nama+"\" sudah ditanggapi",
            showCancelButton: true,
            allowOutsideClick: false,
            cancelButtonColor: '#f25961',
            confirmButtonColor: '#31ce36',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',       
        }).then((result) => {
            if (result.value) {
                updateData(id);
            }
        });
    }

    function updateData(id){
    	Swal.fire({
            title: "Mengirim...",
            text: "Mohon tunggu beberapa saat",
            showConfirmButton: false,
            allowOutsideClick: false
        });

        var form = new FormData();
        form.append("aduan_id", id);
        
        $.ajax({
            type: "POST",
            url: "<?= base_url('pengaduan/update') ?>",
            data: form,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                var content = {};
                content.message = result.message;
                content.title = 'Berhasil';
                content.icon = 'fa fa-check';
                content.url = '#';

                Swal.close();
                $.notify(content,{
                    type: "info",
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                    delay: 0,
                });
                window.location.reload();
            },
            error: function(error) {
                if (error.status == 400) {
                    Swal.fire("Gagal", error.responseJSON.message, "error");
                    return;
                }
                Swal.fire("Gagal", "Maaf server sedang sibuk, silahkan coba lagi nanti.", "error");
            }
        });
    }

    function removeData(id){
    	Swal.fire({
            title: "Mengirim...",
            text: "Mohon tunggu beberapa saat",
            showConfirmButton: false,
            allowOutsideClick: false
        });

        var form = new FormData();
        form.append("aduan_id", id);
        
        $.ajax({
            type: "POST",
            url: "<?= base_url('pengaduan/remove') ?>",
            data: form,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                var content = {};
                content.message = result.message;
                content.title = 'Berhasil';
                content.icon = 'fa fa-trash';
                content.url = '#';

                Swal.close();
                $.notify(content,{
                    type: "danger",
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                    delay: 0,
                });
                table.row('#aduan-'+id).remove().draw( false );
            },
            error: function(error) {
                if (error.status == 400) {
                    Swal.fire("Gagal", error.responseJSON.message, "error");
                    return;
                }
                Swal.fire("Gagal", "Maaf server sedang sibuk, silahkan coba lagi nanti.", "error");
            }
        });
    }

</script>