<!-- Bootstrap core JavaScript -->
<script src="<?php echo e(asset('assets/vendor/jquery/jquery.min.js')); ?>"></script> <!-- jQuery HARUS DIMUAT TERLEBIH DAHULU -->
<script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript -->
<script src="<?php echo e(asset('assets/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

<!-- Custom scripts for all pages -->
<script src="<?php echo e(asset('assets/js/sb-admin-2.min.js')); ?>"></script>

<!-- Load DataTables -->
<script src="<?php echo e(asset('assets/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<!-- Load Select2 (Setelah jQuery dimuat) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Inisialisasi Select2 dan DataTables -->
<script>
    $(document).ready(function () {
        console.log("jQuery Loaded:", typeof jQuery !== 'undefined'); // Debugging jQuery

        // Inisialisasi Select2
        if ($.fn.select2) {
            $('.select2').select2({
                allowClear: true
            });
        } else {
            console.error("Select2 gagal dimuat.");
        }

        // Inisialisasi DataTables
        if ($.fn.DataTable) {
            console.log("Tabel ditemukan?", $('#tabel-data').length); // Harus > 0
            $('#tabel-data').DataTable();
        } else {
            console.error("DataTables gagal dimuat.");
        }
    });

    // Tutup notifikasi otomatis setelah 5 detik
    setTimeout(function () {
        $(".alert").fadeOut("slow");
    }, 5000);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi tanggal selesai harus setelah tanggal mulai
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');

        tanggalMulai.addEventListener('change', function() {
            tanggalSelesai.min = this.value;
            if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
                tanggalSelesai.value = this.value;
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Handle delete confirmation
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        const deleteButtons = document.querySelectorAll('.delete-btn');
        let currentForm = null;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentForm = this.closest('.delete-form');
                deleteModal.show();
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit();
            }
            deleteModal.hide();
        });

        // Auto close alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
<?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\Template\Script.blade.php ENDPATH**/ ?>