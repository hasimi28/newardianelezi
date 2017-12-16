<script>
$('#check').click(function(){

if($(this).prop('checked')){

$('#pass_hide').fadeIn();
$('#pass2_hide').fadeIn();
$('#check').val('yes');

}else{

$('#pass_hide').hide();
$('#pass2_hide').hide();
$('#check').val('no');
}
});




//Insertimi i perdoruesve
$('#submit').on('click',function (e) {
    e.preventDefault();

    var form = $("#forma_edit");
    var info = $('.edit_alert');

    $('.load').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></span>');
    info.find('ul').html('');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url     : form.attr("action"),
        type    : form.attr("method"),
        dataType : 'json',
        data    : form.serialize(),
        success: function(msg) {

                window.location = "{{ URL('backend/users')}}";



        },

        error: function(data){
            var errors = data.responseJSON;

            $.each(errors, function( index, value ) {
                info.find('ul').append('<li>' + value + '</li>');
                info.css('background-color','#F44336');
                $('.load').html('');
            });
        }

    });

});

//Insertimi i perdoruesve
</script>