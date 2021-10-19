var table = $('#dataTableAktif').DataTable({
    "Dom": 'RlfrtlipB',
    "ordering":false,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin+'/permintaan/dataAktif',
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
            "data": "id",
            "render": function (data, type, full, meta) {
                var actions = []; 
                actions.push('<a onclick="up(' + data + ')" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal1" title="Edit" data-content="Ubah"><i class="fas fa-pencil-alt"></i></a>');
                actions.push('<a onclick="del(' + data + ')" class="btn btn-xs btn-danger" data-toggle="popover" data-trigger="hover" title="Hapus" data-content="hapus"><i class="fas fa-trash-alt"></i><a>');
                actions.push('<a href="'+window.location.origin+'/file/'+full.file+'" class="btn btn-xs btn-warning"  title="Download" data-content="download"><i class="fa fa-download"></i></a>');
                actions.push('<a onclick="buka(' + data + ')" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal2" title="Rekomendasi Pembuatan SK" data-content="Ubah"><i class="fas fa-file-invoice"></i></a>');
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

    var table1 = $('#dataTableAktif1').DataTable({
        "Dom": 'RlfrtlipB',
        "ordering":false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": window.location.origin+'/permintaan/dataAktif',
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
                "data": "id",
                "render": function (data, type, full, meta) {
                    var actions = []; 
                    actions.push('<a href="'+window.location.origin+'/file/'+full.file+'" class="btn btn-xs btn-warning"  title="Download" data-content="download"><i class="fa fa-download"></i></a>');
                    actions.push('<a onclick="buka(' + data + ')" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal2" title="Rekomendasi Pembuatan SK" data-content="Ubah"><i class="fas fa-file-invoice"></i></a>');
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

    function buka(id) {
        $.ajax({
            type: 'POST',
            url: window.location.origin+'/permintaan/buka',
            data: {id:id},
            success: function (data) {
            //   console.log(data['petugas']);
              $("p").empty();
              $("ol").empty();

              // $('#tentang').append('<button id="submit">Submit</button>');

              $("p").append(data['sk']['tentang']);

              $.each(data['petugas'], function(i,e){
                $("#petugas1 option[value='" + data['petugas'][i]['id_user'] + "']").prop("selected", true);

                $("ol").append("<li>"+data['petugas'][i]['nip']+" - " +data['petugas'][i]['username'] +"</li>");
                // $("#petugas1 option[value='" + data['petugas'][i]['id_user'] + "']");
                // console.log(data['petugas'][i]['id_user']);
              });

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
                url: window.location.origin+'/permintaan/delet',
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

      function up(id) {
        $.ajax({
            type: 'POST',
            url: window.location.origin+'/permintaan/edit',
            data: {id:id},
            success: function (data) {
            //   console.log(data['petugas']);
              $("input[name='id']").val(data['sk']['id']);
              $("#tentang1").val(data['sk']['tentang']);
              $("#nomor1").val(data['sk']['no']);
              $("#fileold").val(data['sk']['file']);
              $('#status').val(data['sk']['status']);
              $.each(data['petugas'], function(i,e){
                $("#petugas1 option[value='" + data['petugas'][i]['id_user'] + "']").prop("selected", true);
                // $("#petugas1 option[value='" + data['petugas'][i]['id_user'] + "']");
                // console.log(data['petugas'][i]['id_user']);
              });

            }
          });
      }

    //   $("#status").change(function(data){
    //     // Do something here.
    //     console.log(data.value);
    //     $('<input>').attr({
    //         type: 'text',
    //         id: 'foo',
    //         name: 'bar',
    //         class:'form-control form-control-user',
    //         placeholder:"Alasan Sk Tidak Aktif"
    //     }).appendTo('#set');
        
    //   });

    $('#status').on('change', function() {
        // alert( this.value );
        if (this.value == 'Aktif'){
            $("#alasan").remove();
        }else{
            $('<input>').attr({
                type: 'text',
                id: 'alasan',
                name: 'alasan',
                class:'form-control form-control-user',
                placeholder:"Alasan SK Tidak Aktif"
            }).appendTo('#set');
        }
        
    });


      