$(function() {
  $('.contacts-form').validate({
    rules: {
      name: 'required',
      phone: 'required',
      message: 'required',
    },
    messages: {
      name: 'Обязательное поле',
      phone: 'Обязательное поле',
      message: 'Обязательное поле'
    },
    submitHandler: function (form) {
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: $(form).serialize(),
        })
        .done(function (response) {
          $('.contacts-form .wrapper').slideUp();
          $('.contacts-form .final').slideDown();
        }); 
      return false;
    }
  });
});