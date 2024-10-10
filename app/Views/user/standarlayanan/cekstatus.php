<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<style>
    @media (max-width: 403px) {
        .form-check-inline {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-check-inline input[type="radio"] {
            margin-right: 5px;
        }

        .form-check-inline label {
            font-size: 13px;
            white-space: nowrap;
        }
    }
</style>

<div class="container-fluid standarlayanan2 pb-5" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color:black;">Cek Status Formulir</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Cek Status Formulir</h4>
    </div>
    <form>
        <div class="row">
            <div class="mb-3 mt-3 text-center">
                <div class="form-check form-check-inline">
                    <input type="radio" name="selectOption" value="1" id="option1" />
                    <label for="option1" class="form-check-label">Permohonan Informasi Publik</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="selectOption" value="2" id="option2" />
                    <label for="option2" class="form-check-label">Permohonan Keberatan Informasi Publik</label>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div id="formContainer">
            <form id="form1" style="display:none; padding-left: 20px; padding-right: 20px;">
                <div class="mb-3 mt-5 text-center">
                    <h5>Permohonan Informasi Publik</h5>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="kode_permohonan" class="form-label">Kode Permohonan :*</label>
                        <input type="text" class="form-control" name="kode_permohonan" id="kode_permohonan" placeholder="">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-danger me-md-2" type="button" id="cancel-form1-btn">Cancel</button>
                    <button class="btn" id="cek-status-btn" type="button" style="background-color: #28527A; color:#f4d160;">Cek Status</button>
                </div>
            </form>

            <form id="form2" style="display: none; padding-left: 20px; padding-right: 20px;">
                <div class="mb-3 mt-5 text-center">
                    <h5>Permohonan Keberatan Informasi Publik</h5>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="keberatan" class="form-label">Kode Keberatan :*</label>
                        <input type="text" class="form-control" id="keberatan" placeholder="" name="keberatan">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-danger me-md-2" type="button">Cancel</button>
                    <button class="btn" id="cek-status-btn2" type="button" style="background-color: #28527A; color:#f4d160;">Cek Status</button>
                </div>
            </form>
        </div>
    </div>

    <div id="dataContainer" class="mt-4"></div>
</div>


</div>

<!-- <script>
    function cancelForm(formId) {
        const form = document.getElementById(formId);
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = ''; // Menghapus nilai input
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');
        const radioOption1 = document.getElementById('option1');
        const radioOption2 = document.getElementById('option2');
        const formContainer = document.getElementById('formContainer');

        radioOption1.addEventListener('change', function() {
            form1.style.display = 'block';
            form2.style.display = 'none';
        });

        radioOption2.addEventListener('change', function() {
            form1.style.display = 'none';
            form2.style.display = 'block';
        });

        document.getElementById('cek-status-btn').addEventListener('click', function() {
            const kodePermohonan = document.getElementById('kode_permohonan').value;
            fetch(`/StandarLayananController/getPemohon?kode_permohonan=${kodePermohonan}`)
                .then(response => response.text())
                .then(data => {
                    formContainer.innerHTML = data;
                });
        });

        document.getElementById('cek-status-btn2').addEventListener('click', function() {
            const kodeKeberatan = document.getElementById('keberatan').value;
            fetch(`/StandarLayananController/getKeberatan?keberatan=${kodeKeberatan}`)
                .then(response => response.text())
                .then(data => {
                    formContainer.innerHTML = data;
                });
        });

        // Menambahkan event listener untuk tombol cancel pada form 1
        document.getElementById('cancel-form1-btn').addEventListener('click', function() {
            cancelForm('form1');
        });

        // Menambahkan event listener untuk tombol cancel pada form 2
        document.getElementById('cancel-form2-btn').addEventListener('click', function() {
            cancelForm('form2');
        });
    });
</script> -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');
        const radioOption1 = document.getElementById('option1');
        const radioOption2 = document.getElementById('option2');
        const formContainer = document.getElementById('formContainer');

        radioOption1.addEventListener('change', function() {
            form1.style.display = 'block';
            form2.style.display = 'none';
        });

        radioOption2.addEventListener('change', function() {
            form1.style.display = 'none';
            form2.style.display = 'block';
        });

        document.getElementById('cek-status-btn').addEventListener('click', function() {
            const kodePermohonan = document.getElementById('kode_permohonan').value;
            fetch(`/getPemohon?kode_permohonan=${kodePermohonan}`)
                .then(response => response.text())
                .then(data => {
                    formContainer.innerHTML = data;
                });
        });

        document.getElementById('cek-status-btn2').addEventListener('click', function() {
            const kodeKeberatan = document.getElementById('keberatan').value;
            fetch(`/StandarLayananController/getKeberatan?keberatan=${kodeKeberatan}`)
                .then(response => response.text())
                .then(data => {
                    formContainer.innerHTML = data;
                });
        });
    });
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var option1 = document.getElementById('option1');
        var option2 = document.getElementById('option2');
        var form1 = document.getElementById('form1');
        var form2 = document.getElementById('form2');
        var dataContainer = document.getElementById('dataContainer');

        option1.addEventListener('change', function() {
            if (this.checked) {
                form1.style.display = 'block';
                form2.style.display = 'none';
            }
        });

        option2.addEventListener('change', function() {
            if (this.checked) {
                form1.style.display = 'none';
                form2.style.display = 'block';
            }
        });

        document.getElementById('cek-status-btn').addEventListener('click', function() {
            var kodePermohonan = document.getElementById('kode_permohonan').value;
            $.ajax({
                url: '<?= base_url('cekstatus/get_data') ?>',
                method: 'POST',
                data: {
                    option: '1',
                    kode_permohonan: kodePermohonan
                },
                success: function(response) {
                    dataContainer.innerHTML = response;
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });

        document.getElementById('cek-status-btn2').addEventListener('click', function() {
            var kodeKeberatan = document.getElementById('keberatan').value;
            $.ajax({
                url: '<?= base_url('cekstatus/get_data') ?>',
                method: 'POST',
                data: {
                    option: '2',
                    kode_keberatan: kodeKeberatan
                },
                success: function(response) {
                    dataContainer.innerHTML = response;
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    });
</script> -->

<?= $this->endSection(''); ?>