$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
});
const lang = $('html')[0].lang;

$(document).on('click', '#addMorePosts', function(e){
  const count = $('article').length;
  const categoryId = $(this).data('id');
  $.ajax({
      type: "POST",
      url: '/' + lang + '/events/addMorePosts',
      data: {count, categoryId},
      success: function(data) {
          const res = JSON.parse(data);
          $('.events-container').html(res.posts);
      }
  });

  e.preventDefault();
});

$(document).on('submit', '#sendContactForm', function(e){
  const name = $('#sendContactForm input[name="name"]').val();
  const email = $('#sendContactForm input[name="email"]').val();
  const message = $('#sendContactForm input[name="message"]').val();
  $.ajax({
      type: "POST",
      url: '/' + lang + '/contacts',
      data: {name, email, message},
      success: function(data) {
          $('#sendContactForm .alert.alert-danger').css('display', 'none');
          $('#sendContactForm .alert.alert-success').html(data).css('display', 'block');
      },
      error: function(err) {
          $('#sendContactForm .alert.alert-danger').html(err.responseJSON.errors.join('<br>')).css('display', 'block');
          $('#sendContactForm .alert.alert-success').css('display', 'none');
      }
  });

  e.preventDefault();
});

$('.search-field').on('keyup', function(){
    var val = $(this).val();
    if (val.length > 2) {
        $.ajax({
            type: "POST",
                url: '/' + lang + '/search/autocomplete',
            data:{
                value: val,
            },
            success: function(data) {
                var res = JSON.parse(data);
                $('.searchResult').html(res);
            }
        });
    }else{
        $('.searchResult').html('');
    }
});
