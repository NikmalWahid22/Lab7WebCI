<?= $this->include('template/admin_header'); ?>

<h2>Tambah Artikel</h2>

<form id="formTambah" method="post" enctype="multipart/form-data">

<p>
    <label>Judul</label><br>
    <input type="text" name="judul">
</p>

<p>
    <label>Isi</label><br>
    <textarea name="isi" rows="10" cols="50"></textarea>
</p>

<p>
    <label>Kategori</label><br>
    <select name="id_kategori">
        <option value="">-- Pilih Kategori --</option>
        <?php foreach($kategori as $k): ?>
            <option value="<?= $k['id_kategori']; ?>">
                <?= $k['nama_kategori']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</p>

<p>
    <label>Gambar</label><br>
    <input type="file" name="gambar">
</p>

<p>
    <button type="submit" class="btn">Kirim</button>
</p>

</form>

<script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>
<script>
$('#formTambah').submit(function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "<?= base_url('ajax/create') ?>",
        type: "POST",
        data: formData,

        processData: false,
        contentType: false,

        success: function(res){
            alert('Artikel berhasil ditambahkan');
            window.location.href = "<?= base_url('admin/artikel') ?>";
        },

        error: function(xhr){
            console.log(xhr.responseText);
            alert('Gagal menambahkan artikel');
        }
    });

});
</script>

<?= $this->include('template/admin_footer'); ?>