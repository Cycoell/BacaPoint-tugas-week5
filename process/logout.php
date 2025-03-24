<script>
    if (confirm("Apakah Anda yakin ingin logout?")) {
        window.location.href = '../process/logout_process.php';
    } else {
        window.location.href = '../public/dashboard.php'; // Kembali ke dashboard jika batal logout
    }
</script>