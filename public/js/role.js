var table = $('#dataTableRole').DataTable({
    "Dom": 'RlfrtlipB',
    "ordering":false,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin+'/role/dataRole',
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
        "data": "level",
        "render": function (data, type, full, meta) {
                var kod = "";
                if (full.level == '1'){
                    kod += 'Super Admin';
                }
                if (full.level  == '2'){
                    kod += 'Admin';
                }
                if(full.level  == '3'){
                    kod += 'Ketua';
                }
                if(full.level  == '4'){
                    kod += 'User';
                }
                return kod;
        }
        },
    ],
    createdRow:function(row, data, rowIndex)
		{
			$.each($('td', row), function(colIndex){
                if(colIndex == 4)
				{
					$(this).attr('data-name', 'level');
					$(this).attr('class', 'level');
					$(this).attr('data-type', 'select');
					$(this).attr('data-pk', data['id']);
				}


			});
		},
   
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
    $('#dataTableRole').editable({
		container:'body',
		selector:'td.level',
		url:window.location.origin+'/role/editLevel',
		title:'Level',
		type:'POST',
		datatype:'json',
		source:[{value: "1", text: "Super Admin"}, {value: "2", text: "Admin"}, {value: "3", text: "Ketua"}, {value: "4", text: "User"}],
		validate:function(value){
			if($.trim(value) == '')
			{
				return 'This field is required';
			}
		}
	});