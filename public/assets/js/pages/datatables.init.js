$(document).ready(function () {
    // Inisialisasi DataTables
    $(".table").each(function () {
        var table = $(this);

        if (!$.fn.DataTable.isDataTable(this)) {
            var tableInstance = table.DataTable({
                autoWidth: false,
                deferRender: true,
                dom: "Bftip",
                scrollX: true,
                lengthChange: false,
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
                columnDefs: [{ visible: false, targets: [] }],

                // Fitur pencarian di footer kolom
                initComplete: function () {
                    var api = this.api(); // Simpan referensi API DataTables

                    // Iterasi setiap kolom
                    api.columns().every(function () {
                        var column = this;
                        var title = $(column.header()).text().trim(); // Ambil judul kolom dari header

                        // Check if the column has a footer
                        if ($(column.footer()).length) {
                            if (title === "Status") {
                                // Dropdown untuk kolom Status
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
                                // Text input untuk kolom lainnya
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
        }
    });

    // Spinner dan reload DataTables saat tab RT berubah
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var targetTab = $(e.target).attr('href'); // ID tab target
        var spinner = $("#loading-spinner");

        // Tampilkan spinner dan sembunyikan konten
        spinner.removeClass("d-none");
        $(".tab-pane").removeClass("show active");

        setTimeout(function () {
            // Aktifkan tab target setelah delay
            $(targetTab).addClass("show active");

            // Render ulang DataTables di tab aktif
            var table = $(targetTab).find(".table");
            if (table.length && $.fn.DataTable.isDataTable(table)) {
                var tableInstance = table.DataTable();

                // Reset ukuran kolom agar layout tidak rusak
                tableInstance.columns.adjust().draw(false);
            }

            // Sembunyikan spinner
            spinner.addClass("d-none");
        }, 500); // Delay 500ms
    });
});
