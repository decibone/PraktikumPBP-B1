document.addEventListener('DOMContentLoaded', function() {
    buatCaptcha();
    updateSubKategori();
    toggleHargaGrosir();

    document.getElementById('kategori').addEventListener('change', updateSubKategori);
    document.getElementById('grosirYa').addEventListener('change', toggleHargaGrosir);
    document.getElementById('grosirTidak').addEventListener('change', toggleHargaGrosir);
    document.getElementById('productForm').addEventListener('submit', validateForm);

    document.querySelector('input[type="reset"]').addEventListener('click', function(event) {
        resetForm();
    });
});

function updateSubKategori() {
    const kategori = document.getElementById('kategori').value;
    const subKategori = document.getElementById('subKategori');
    subKategori.innerHTML = '<option value="">--Pilih Sub Kategori--</option>';

    if (kategori === 'Baju') {
        addOption(subKategori, 'Baju Pria');
        addOption(subKategori, 'Baju Wanita');
        addOption(subKategori, 'Baju Anak');
    } else if (kategori === 'Elektronik') {
        addOption(subKategori, 'Mesin Cuci');
        addOption(subKategori, 'Kulkas');
        addOption(subKategori, 'AC');
    } else if (kategori === 'Alat Tulis') {
        addOption(subKategori, 'Kertas');
        addOption(subKategori, 'Map');
        addOption(subKategori, 'Pulpen');
    }
}

function addOption(selectElement, value) {
    const option = document.createElement('option');
    option.text = value;
    option.value = value;
    selectElement.add(option);
}

function toggleHargaGrosir() {
    const hargaGrosir = document.getElementById('hargaGrosir');
    hargaGrosir.disabled = document.getElementById('grosirTidak').checked;
    if (hargaGrosir.disabled) {
        hargaGrosir.value = '';
    }
}

function buatCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let captcha = '';
    for (let i = 0; i < 5; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('captcha').value = captcha;
}

function validateForm(event) {
    event.preventDefault();
    let isValid = true;
    const errors = {};

    const namaProduk = document.getElementById('namaProduk').value;
    if (namaProduk.length < 5 || namaProduk.length > 30) {
        errors.namaProduk = 'Nama produk harus antara 5 dan 30 karakter.';
        isValid = false;
    }

    const deskripsi = document.getElementById('deskripsi').value;
    if (deskripsi.length < 5 || deskripsi.length > 100) {
        errors.deskripsi = 'Deskripsi harus antara 5 dan 100 karakter.';
        isValid = false;
    }

    const kategori = document.getElementById('kategori').value;
    const subKategori = document.getElementById('subKategori').value;
    if (!kategori) {
        errors.kategori = 'Kategori harus dipilih.';
        isValid = false;
    }
    if (!subKategori) {
        errors.subKategori = 'Sub Kategori harus dipilih.';
        isValid = false;
    }

    const hargaSatuan = document.getElementById('hargaSatuan').value;
    if (isNaN(hargaSatuan) || hargaSatuan === '') {
        errors.hargaSatuan = 'Harga satuan harus berupa angka.';
        isValid = false;
    }

    const grosirYa = document.getElementById('grosirYa').checked;
    const hargaGrosir = document.getElementById('hargaGrosir').value;
    if (grosirYa && hargaGrosir === '') {
        errors.hargaGrosir = 'Harga grosir harus berupa angka.';
        isValid = false;
    }

    const jasaKirim = document.querySelectorAll('input[name="jasaKirim"]:checked');
    if (jasaKirim.length < 3) {
        errors.jasaKirim = 'Minimal 3 jasa kirim harus dipilih.';
        isValid = false;
    }

    const captcha = document.getElementById('captcha').value;
    const captchaInput = document.getElementById('captchaInput').value;
    if (captcha !== captchaInput) {
        errors.captcha = 'Captcha tidak sesuai.';
        isValid = false;
    }

    for (const [key, value] of Object.entries(errors)) {
        document.getElementById(`${key}Error`).textContent = value;
    }

    if (isValid) {
        const form = document.getElementById('productForm');
        form.action = window.location.href + '?submitted=true';
        form.submit();
    }

    return isValid;
}

function resetForm() {
    window.location.href = window.location.pathname;
}