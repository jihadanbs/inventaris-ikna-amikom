
$(document).ready(function() {
    // Inisialisasi DataTable untuk semua tabel dengan kelas .datatable
    $(".datatable").DataTable({
       responsive: false
   });

   // Inisialisasi DataTable untuk semua tabel dengan kelas .datatable1
   $(".datatable1").DataTable({
       responsive: false
   });

   // Menambahkan kelas pada elemen select di dalam DataTables
   $(".dataTables_length select").addClass("form-select form-select-sm");
});