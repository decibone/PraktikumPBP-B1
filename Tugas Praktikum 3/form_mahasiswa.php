<?php
$errors = [];
$success = false;

//Validasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nis'])) {
        $errors['nis'] = "NIS harus diisi";
    } elseif (!preg_match("/^[0-9]{10}$/", $_POST['nis'])) {
        $errors['nis'] = "NIS harus terdiri dari 10 digit angka";
    }

    if (empty($_POST['nama'])) {
        $errors['nama'] = "Nama harus diisi";
    }

    if (empty($_POST['jenis_kelamin'])) {
        $errors['jenis_kelamin'] = "Jenis kelamin harus dipilih";
    }

    if (empty($_POST['kelas'])) {
        $errors['kelas'] = "Kelas harus dipilih";
    }

    if ($_POST['kelas'] != 'XII') {
        if (empty($_POST['ekstrakurikuler']) || count($_POST['ekstrakurikuler']) < 1 || count($_POST['ekstrakurikuler']) > 3) {
            $errors['ekstrakurikuler'] = "Pilih 1 sampai 3 ekstrakurikuler";
        }
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <style>
        body {
            font-family: Arial;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Form Input Siswa</h1>
    <h3>Nama: Laurentius Lucky</h3>
    <h3>NIM: 24060122130100</h3>

    <form method="post" action="">
        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" id="nis" name="nis" value="<?= isset($_POST['nis']) ? htmlspecialchars($_POST['nis']) : '' ?>">
            <?php if (isset($errors['nis'])): ?>
                <span class="error"><?= $errors['nis'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
            <?php if (isset($errors['nama'])): ?>
                <span class="error"><?= $errors['nama'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <input type="radio" id="pria" name="jenis_kelamin" value="Pria" <?= (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Pria') ? 'checked' : '' ?>> Pria
            <input type="radio" id="wanita" name="jenis_kelamin" value="Wanita" <?= (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Wanita') ? 'checked' : '' ?>> Wanita
            <?php if (isset($errors['jenis_kelamin'])): ?>
                <span class="error"><?= $errors['jenis_kelamin'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <select id="kelas" name="kelas">
                <option value="">Pilih Kelas</option>
                <option value="X" <?= (isset($_POST['kelas']) && $_POST['kelas'] == 'X') ? 'selected' : '' ?>>X</option>
                <option value="XI" <?= (isset($_POST['kelas']) && $_POST['kelas'] == 'XI') ? 'selected' : '' ?>>XI</option>
                <option value="XII" <?= (isset($_POST['kelas']) && $_POST['kelas'] == 'XII') ? 'selected' : '' ?>>XII</option>
            </select>
            <?php if (isset($errors['kelas'])): ?>
                <span class="error"><?= $errors['kelas'] ?></span>
            <?php endif; ?>
        </div>

        <div id="ekstrakurikuler-group" class="form-group" style="display: <?= (isset($_POST['kelas']) && $_POST['kelas'] != 'XII') ? 'block' : 'none' ?>;">
            <label>Ekstrakurikuler:</label><br>
            <input type="checkbox" id="pramuka" name="ekstrakurikuler[]" value="Pramuka" <?= (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler'])) ? 'checked' : '' ?>> Pramuka
            <input type="checkbox" id="seni_tari" name="ekstrakurikuler[]" value="Seni Tari" <?= (isset($_POST['ekstrakurikuler']) && in_array('Seni Tari', $_POST['ekstrakurikuler'])) ? 'checked' : '' ?>> Seni Tari
            <input type="checkbox" id="sinematografi" name="ekstrakurikuler[]" value="Sinematografi" <?= (isset($_POST['ekstrakurikuler']) && in_array('Sinematografi', $_POST['ekstrakurikuler'])) ? 'checked' : '' ?>> Sinematografi
            <input type="checkbox" id="basket" name="ekstrakurikuler[]" value="Basket" <?= (isset($_POST['ekstrakurikuler']) && in_array('Basket', $_POST['ekstrakurikuler'])) ? 'checked' : '' ?>> Basket
            <br />
            <?php if (isset($errors['ekstrakurikuler'])): ?>
                <span class="error"><?= $errors['ekstrakurikuler'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>

    <script src="form_mahasiswa_js.js"></script>
</body>
</html>