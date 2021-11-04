var table = $('#dataTableTidakAktif').DataTable({
    "Dom": 'RlfrtlipB',
    "ordering":false,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin+'/permintaan/dataTidakAktif',
    },
    "columns": [
        {
        "data": "rownum"
        },
        {
            "data": "no"
            },
        {
        "data": "tentang"
        },
        {
            "data": "alasan"
            },
      
        {
            "data": "id",
            "render": function (data, type, full, meta) {
                var actions = [];         
                actions.push('<a href="'+window.location.origin+'/file/'+full.file+'" class="btn btn-xs btn-warning" target="_blank"  title="Download" data-content="download"><i class="fa fa-download"></i></a>');
                return actions.join('&nbsp;');
            }
        },
       
    ],
    
        language: {
            "decimal": "",
            "emptyTable": "Tidak ada data yang ditemukan",
            "info": "Menampilkan _START_ sd _END_ dari _TOTAL_ Entri",
            "infoEmpty": "Menampilkan 0 sd 0 dari 0 Entri",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Tampilkan _MENU_",
            "loadingRecords": "Mengambil data...",
            "processing": "Memproses...",
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": ">",
                "previous": "<"
            },
        },
    });

  