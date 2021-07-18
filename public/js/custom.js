
$('form[is-dynamic-form]').submit(function(e) {

    e.preventDefault();
    resetErrorMessages(this);

    var thiis = this;
    
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

      type: $(this).attr('method'),
      url:  $(this).attr('action'),
      typeData: 'JSON',
      data: new FormData($(this)[0]),
      processData: false,
      contentType: false,
      cache: false,

      success: function(data) {

        if(data.notification) {
          callToast( data.notification.title,
                     data.notification.msg,
                     data.notification.type
                   );
                   
          if(data.notification.type === 'success') {
            initializeForm(thiis); //Reset form
          }
        }

        if(data.callback && typeof window[data.callback.name] == 'function') {
           window[data.callback.name](data.callback.args);
        }

        $('html,body').animate({ scrollTop: '0px' },'slow');      // Scroll to top of the page

      }, 

      error: function(data) {

        if(data.status == 422) {
          $.each(data.responseJSON.errors, function(key,value) {
            $('#' + key ).addClass('is-invalid');
            $('.' + key + '-error').html(value);
          });

          $('html,body').animate({ scrollTop: $(".is-invalid").offset().top-100 },'slow');

        }else { toastr.error('Erreur lors de l\'envoi', 'Une erreur est servenue lors de l\'envoi, veuillez vérifier vos champs'); }
      }

    }); 
});

function initializeForm(form) {

    $(form).find('input,select,textarea').each(function (i,field) {
      $(field).val('');
    });

    if($("#uploadFile").length) {
      Dropzone.forElement('#uploadFile').removeAllFiles(true); // Clear dropzone files
    }
}

// Reset error messages
function resetErrorMessages(form) {
  $(form).find("input, select, textarea").each(function (i, field) {
      $(field).removeClass('is-invalid'); 
  });
}

// Remove Table row after delete
function removeTableRow(id) {
  $('#info_row_' + id).fadeOut(300, function() { $(this).remove(); });
}

// TOAST NOTIFIER 
function callToast(title, message, typeAlert) {
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: 'toast-bottom-right',
        preventDuplicates: false,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: 3000,
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };

    switch (typeAlert) {
        case "error":
            toastr.error(message, title);
            break;

        case "success":
            toastr.success(message, title);
            break;

        case "info":
            toastr.info(message, title);
            break;

        case "warning":
            toastr.warning(message, title);
            break;
    }
}
