$('#log').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

   // add the rule here
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Select you status pegawai");

  $('#reg').validate({
    rules: {
      username: {
        required: true,
      },
      email: {
        required: true,
        email: true,
        remote: '/login/checkEmail',
      },
      password: {
        required: true,
        minlength: 5
      },
      statusPegawai: { 
        valueNotEquals: "default" 
      },
      repeatPassword : {
        equalTo : "#password"
      }
    },
     // Specify validation Error messages
     messages: {
      email: {
        remote:"Email already exist"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });


  $('#profile').validate({
    rules: {
      username: {
        required: true,
      },
      statusPegawai: { 
        valueNotEquals: "default" 
      },
      nip: { 
        required: true,
      },
      photo: {
        extension: "JPG|PNG|jpg"
      },
    },
    messages: {
      photo: {
        extension:"Format img JPG,PNG"
      },
     },

    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

 
  $('#for').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
    },
     // Specify validation Error messages
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#pas').validate({
    rules: {
      password: {
        required: true,
        minlength: 5
      },
    },
     // Specify validation Error messages
     messages: {
      email: {
        remote:"Email already exist"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#tambahData').validate({
    rules: {
      username: {
        required: true,
      },
      nip: {
        required: true,
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: "/pegawai/checkEmail",
          type: "post",
          data: {
            email: function() {
              return $( "#email" ).val();
            }
          }
        }
      },

    },
     // Specify validation Error messages
     messages: {
      email: {
        remote:"Email already exist"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });


  $('#ubahData').validate({
    rules: {
      username1: {
        required: true,
      },
      nip1: {
        required: true,
      },
      // email1: {
      //   required: true,
      //   email: true,
      //   remote: {
      //     url: "/pegawai/checkEmail",
      //     type: "post",
      //     data: {
      //       email1: function() {
      //         return $( "#email1" ).val();
      //       }
      //     }
      //   }
      // },

    },
     // Specify validation Error messages
    //  messages: {
    //   email1: {
    //     remote:"Email already exist"
    //   },
    //  },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });



  $('#ubahDataPermintaan').validate({
    rules: {
      tentang1: {
        required: true,
      },
      'petugas1[]': {
          required: true,
          minlength: 1
      },

    },
     // Specify validation Error messages
     messages: {
      'petugas1[]': {
        minlength:"Select you petugas, Minimum one petugas"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#tambahDataPermintaan').validate({
    rules: {
      tentang: {
        required: true,
      },
      'petugas[]': {
          required: true,
          minlength: 1
      },

    },
     // Specify validation Error messages
     messages: {
      'petugas[]': {
        minlength:"Select you petugas, Minimum one petugas"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#buatDataPermintaan').validate({
    rules: {
      tentang2: {
        required: true,
      },
      nomor: {
        required: true,
      },
      file: {
        required: true,
        extension: "pdf|docx"

      },
      'petugas2[]': {
          required: true,
          minlength: 1
      },

    },
     // Specify validation Error messages
     messages: {
      'petugas2[]': {
        minlength:"Select you petugas, Minimum one petugas"
      },
      file: {
        extension:"Format File PDF,DOCX"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#ubahDataSk').validate({
    rules: {
      tentang1: {
        required: true,
      },
      nomor1: {
        required: true,
      },
      file: {
        extension: "pdf|docx"

      },
      'petugas1[]': {
          required: true,
          minlength: 1
      },

    },
     // Specify validation Error messages
     messages: {
      'petugas1[]': {
        minlength:"Select you petugas, Minimum one petugas"
      },
      file: {
        extension:"Format File PDF,DOCX"
      },
     },
    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
//   $('#statusPegawai').change(function() {
//     // if($('#myselect option:selected').val() == 0) {
//     // }
//     if ($('#statusPegawai option:selected').val() != "Honor"){
//          console.log($('#statusPegawai option:selected').val());
//     }
 

// });