<script>

$('#crud').click(function(){
    if($(this).prop('checked')){


        $('.crud').show();
        $('.basic').hide();
}else{

        $('.basic').show();
    }
});

$('#basic').click(function(){
    if($(this).prop('checked')){

        $('.basic').show();
        $('.crud').hide();

    }else{

        $('.basic').hide();
    }
});

</script>