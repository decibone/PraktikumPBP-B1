document.addEventListener('DOMContentLoaded', function() {
    var kelasSelect = document.getElementById('kelas');
    var ekstrakurikulerGroup = document.getElementById('ekstrakurikuler-group');

    function toggleEkstrakurikuler() {
        if (kelasSelect.value === 'XII') {
            ekstrakurikulerGroup.style.display = 'none';
        } else {
            ekstrakurikulerGroup.style.display = 'block';
        }
    }

    kelasSelect.addEventListener('change', toggleEkstrakurikuler);
    toggleEkstrakurikuler();
});