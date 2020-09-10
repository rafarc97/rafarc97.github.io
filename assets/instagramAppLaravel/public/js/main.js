var url = 'http://localhost/instagramAppLaravel/public';

window.addEventListener('load',function(){

    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');


    //Botón like (cambio de color)
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url + '/img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('has dado like');
                    }else{
                        console.log('error al dar like');
                    }
                }
            });
            dislike();
        });
    }
    like();

    //Botón dislike (cambio de color)
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url + '/img/heart-black.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('has dado dislike');
                    }else{
                        console.log('error al dar dislike');
                    }
                }
            });
            like();
        });
    }
    dislike();

    // BUSCADOR
    $('#buscador').submit(function(e){
        /* e.preventDefault(); */
        $(this).attr('action',url + '/gente/' + $('#buscador #search').val());
        /* $(this).submit(); */
    })
});

/* document.addEventListener('DOMContentLoaded',() => {

    var url = 'http://localhost/instagramAppLaravel/public'
    const $btnLike = document.querySelectorAll('.btn-like');
    const $btnDislike = document.querySelectorAll('.btn-dislike');

    console.log($btnLike);
    console.log($btnDislike);

    function like(){
        $btnLike.addEventListener('click',function(e){
            console.log(e.target);
            $btnLike.classList.replace('btn-dislike','btn-like');
            $btnLike.removeAttribute('src');
            $btnLike.setAttribute('src',url + '/img/heart-red.png');
        });
        dislike();
    }
    like();

    function dislike(){
        $btnDislike.addEventListener('click',function(e){
            $btnDislike.classList.replace('btn-like','btn-dislike');
            $btnLike.removeAttribute('src');
            $btnDislike.setAttribute('src',url + '/img/heart-black.png');
        });
        like();
    }
    dislike();
}); */






