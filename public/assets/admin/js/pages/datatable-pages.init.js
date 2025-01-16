$(document).ready(function() {
    // Inisialisasi DataTable untuk semua tabel dengan kelas .datatable
    $(".datatable").DataTable({
        responsive: true // Mengaktifkan responsif
    });

    // Inisialisasi DataTable untuk semua tabel dengan kelas .datatable1
    $(".datatable1").DataTable({
        responsive: true,
         // Mengaktifkan responsif
    });

    // Menambahkan kelas pada elemen select di dalam DataTables
    $(".dataTables_length select").addClass("form-select form-select-sm");
});
