var table = $('#dataTableHakim').DataTable({
    "Dom": 'RlfrtlipB',
    "ordering":false,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin+'/hakim/dataHakim',
    },
    "columns": [
        {
        "data": "rownum"
        },
        {
        "data": "username"
        },
        {
        "data": "nip"
        },
        {
        "data": "email"
        },
        {
        "data": "nohp"
        },
        {
          "data": "statusAktif"
        },
        {
            "data": "id",
            "render": function (data, type, full, meta) {
                var actions = []; 
                actions.push('<a onclick="up(' + data + ')" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal1" title="Edit" data-content="Ubah"><i class="fas fa-pencil-alt"></i></a>');
                actions.push('<a onclick="del(' + data + ')" class="btn btn-xs btn-danger" data-toggle="popover" data-trigger="hover" title="Hapus" data-content="hapus"><i class="fas fa-trash-alt"></i><a>');
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

    var table1 = $('#dataTableHakim1').DataTable({
      "Dom": 'RlfrtlipB',
      "ordering":false,
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": window.location.origin+'/hakim/dataHakim',
      },
      "columns": [
          {
          "data": "rownum"
          },
          {
          "data": "username"
          },
          {
          "data": "nip"
          },
          {
          "data": "email"
          },
          {
          "data": "nohp"
          },
          {
            "data": "statusAktif"
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

    function up(id) {
        $.ajax({
            type: 'POST',
            url: window.location.origin+'/hakim/edit',
            data: {id:id},
            success: function (data) {
              console.log(data[0]['id']);
              $("input[name='id']").val(data[0]['id']);
              $("input[name='username1']").val(data[0]['username']);
              $("input[name='email1']").val(data[0]['email']);
              $("input[name='nip1']").val(data[0]['nip']);
              $("input[name='nohp1']").val(data[0]['nohp']);
              // $("input[name='statusAktif']").val(data[0]['statusAktif']);
              // $('#statusAktif').val(data[0]['statusAktif']);
            }
          });
      }

      function del(id) {
        Swal.fire({
          title: 'Apa kamu yakin ?',
          text: "Kamu akan menghapus data ini !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then(function (result) {
          if (result.value) {
            $.ajax({
                type: 'POST',
                url: window.location.origin+'/hakim/delet',
                data: {id:id},
                success: function() {
                  var toast = swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      padding: '2em'
                  });
                  toast.fire({
                      icon: 'success',
                      title: 'Successfully delet a  account',
                      padding: '2em'
                  });
                  table.ajax.reload();
                  table1.ajax.reload();
                  
                }, error: function(response){
                    console.log(response.responseText);
                }
            });
          }
        });
      }
  
   