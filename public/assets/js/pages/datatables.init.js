$(document).ready(function () {
    // Inisialisasi DataTable
    $(".table").each(function () {
        var table = $(this);

        // Cek apakah menggunakan server-side processing
        var isServerProcessing = table.data("server-processing") === true;
        var ajaxUrl = table.data("url");
        var colVis = table.data("colvis")
            ? table.data("colvis")
            : [-6, -5, -4, -3, 1];

        // Inisialisasi DataTable dengan atau tanpa server-side processing
        var tableInstance = table.DataTable({
            dom: "Bftip",
            scrollX: true,
            lengthChange: false,
            processing: isServerProcessing, // Tampilkan indikator loading jika server processing aktif
            serverSide: isServerProcessing, // Aktifkan server-side processing sesuai kebutuhan
            ajax: isServerProcessing
                ? {
                      url: ajaxUrl, // Ganti dengan URL yang sesuai
                      type: "GET",
                      data: function (d) {
                          // Tambahkan data tambahan jika diperlukan
                          d.class_id = $("#classSelect").val(); // Misal mengambil class_id dari dropdown
                      },
                  }
                : null, // Jika tidak server-side, tidak perlu ajax
            buttons: [
                "copy",
                "excel",
                "pdf",
                {
                    extend: "colvis",
                    className: "custom-colvis-btn",
                    postfixButtons: ["colvisRestore"],
                    columnText: function (dt, idx, title) {
                        return title;
                    },
                },
            ],
            searching: true,
            columnDefs: [{ visible: false, targets: colVis }],
            initComplete: function () {
                // Simpan referensi API DataTables
                var api = this.api();

                // Iterasi setiap kolom
                api.columns().every(function () {
                    var column = this;
                    var title = $(column.header()).text().trim(); // Ambil judul kolom dari header

                    console.log(title);

                    // Check if the column has a footer
                    if ($(column.footer()).length) {
                        if (title === "Status") {
                            // Dynamically identify the "Status" column based on its header text
                            $(
                                '<select class="form-control"><option value="">All</option><option value="Aktif">Aktif</option><option value="Non Aktif">Nonaktif</option></select>'
                            )
                                .appendTo($(column.footer()).empty())
                                .on("change", function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(
                                            val ? "^" + val + "$" : "",
                                            true,
                                            false
                                        )
                                        .draw();
                                });
                        } else {
                            // Create a text input for other columns
                            $(
                                '<input class="form-control" type="text" placeholder="Search ' +
                                    title +
                                    '" />'
                            )
                                .appendTo($(column.footer()).empty())
                                .on("keyup change clear", function () {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        }
                    }
                });
            },
        });

        // Menempatkan tombol di dalam kontainer yang sesuai
        tableInstance
            .buttons()
            .container()
            .appendTo(
                table.closest(".dataTables_wrapper").find(".col-md-6:eq(0)")
            );
    });
});
