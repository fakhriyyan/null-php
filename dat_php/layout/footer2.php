<!-- jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<!-- load fontawesome with cdn-->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

<!-- load ckeditor cdn-->
<!-- Versi CKEditor 4 yang ringan dan stabil -->
<script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>



<script>
  CKEDITOR.replace('alamat',{  
    filebrowserBrowseUrl:'assets/ckfinder/ckfinder.html',
    filebrowserUploadUrl:'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    height: '400px'
  });
</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>

