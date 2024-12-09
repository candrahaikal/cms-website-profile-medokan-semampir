$(document).ready(function () {
    // Inisialisasi DataTables
    $(".table").each(function () {
        var table = $(this);

        if (!$.fn.DataTable.isDataTable(this)) {
            var tableInstance = table.DataTable({
                autoWidth: false,
                deferRender: true,
                dom: "ftip", // Hanya menampilkan table, pagination, dan informasi
                scrollX: true,
                lengthChange: false,
                columnDefs: [{ visible: false, targets: [] }],

                // Hapus fitur initComplete terkait footer pencarian
                initComplete: function () {
                    // Tidak ada pengaturan tambahan untuk kolom
                },
            });
        }
    });

    // Spinner dan reload DataTables saat tab RT berubah
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var targetTab = $(e.target).attr("href"); // ID tab target
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
