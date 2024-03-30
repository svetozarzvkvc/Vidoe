


$(document).keydown(function(e) {
    if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
        return false;
    }
    if (e.which === 123) {
        return false;
    }
    if (e.metaKey) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        return false;
    }
    if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        return false;
    }
    if (e.keyCode == 224 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        return false;
    }
    if (e.ctrlKey && e.keyCode == 85) {
        return false;
    }
    if (event.keyCode == 123) {
        return false;
    }
});
(function($) {
    "use strict";
    $(document).on('click', '#sidebarToggle', function(e) {
        e.preventDefault();
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($window.width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });
    const objowlcarousel = $('.owl-carousel-category');
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                },
                1200: {
                    items: 8,
                },
            },
            loop: true,
            lazyLoad: true,
            autoplay: true,
            autoplaySpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            nav: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        });
    }
    const mainslider = $('.owl-carousel-login');
    if (mainslider.length > 0) {
        mainslider.owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            autoplay: true,
            autoplaySpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
        });
    }
    $('[data-toggle="tooltip"]').tooltip()
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });
    $(document).on('click', 'a.scroll-to-top', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });
})(jQuery);


//moj JS
$(document).on('click', '.comment-replies', function (e){
    e.preventDefault();
    var dugme = $('.dugme');
    var sakrij = $(this).nextAll('.reviews-members');
    sakrij.slideToggle();
    dugme.toggleClass('fa-caret-down fa-caret-up');
})

$(document).on('click', '.comment-reply-btn', function (e) {
    e.preventDefault();
    var replyForm = $(this).parent().find('.reply-form');

    if (replyForm.length) {
        replyForm.slideToggle();
    } else {
        var divElementReply = $(`<div class="reply-form">
                                    <input type="text" id="reply" class="form-control mb-2 mt-3">
                                    <a class="total-like cancel-collapse">Cancel</a>
                                    <a class="total-like submit-reply ml-2">Submit</a>
                                </div>`);

        $(this).parent().append(divElementReply);
        divElementReply.hide().slideDown();
    }
});

$(document).on('click', '.cancel-collapse', function () {
    $(this).closest('.reply-form').slideUp();
    $('#reply').val('');
});



$(document).on('click', '.submit-reply', function () {

    var text = $('#reply').val();
    var videoid = $('#videoid').val();
    var parentid = $(this).closest('.reviews-members').find('.parentcc').val();

    $.ajax({
        url:'/comments',
        method:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType:'json',
        data:{
            videotext:text,
            videoid:videoid,
            parentid:parentid
            //_token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function (){
            //console.log('radi');
            $(this).closest('.reply-form').slideUp();

            fetch('/comments/'+ $('#videoid').val())
                .then(response => response.json())
                .then(json => {
                    updateCommentCount();
                    writeComments(json);
                });

        }.bind(this)
    })
});

$(document).on('click', '#main-comment-submit', function (e){
    e.preventDefault();
    var idTrenutni = $("#userId").val();
    //console.log(idTrenutni);
    if (idTrenutni === "null"){
        window.location.href="/login";
        return;
    }
    var text = $('#main-comment-text').val();
    var videoid = $('#videoid').val();
    //console.log(text);
    $.ajax({
        url:'/comments',
        method:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType:'json',
        data:{
            videotext:text,
            videoid:videoid
            //_token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function (){
            fetch('/comments/'+ $('#videoid').val())
                .then(response => response.json())
                .then(json => {
                    updateCommentCount();
                    writeComments(json);
                });
            $('#main-comment-text').val('');
            //console.log('radi');
        }
    })
});

$('.subscribe-button').click(function (){
    var element = document.getElementsByClassName('subscribe-button')[0];
    var subscribedId = $('#subscribed-id').val();
    //console.log(subscribedId);
    if(element.classList.contains('btn-danger')){
        element.classList.remove('btn-danger');
        element.classList.add('btn-outline-secondary');
        element.textContent = "Subscribed";
        //insert...
        $.ajax({
            url:'/insertSub',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data)
                        if(data.totalSubs === 1){
                            $("#subs-number").html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            $("#subs-number").html(`${data.totalSubs} subscribers`);

                        }
                        var url = xxxRoute.replace(':xxx', data.channel.id);
                        var avatar = xxxAvatar.replace(':xxx1',data.channel.avatar);
                        var elementSide = document.createElement('li');
                        elementSide.classList.add('channel-sidebar-list-item');
                        elementSide.innerHTML = `
                               <input type="hidden" name="sidebar-item" class="sidebar-item" value="${data.channel.id}"/>

                                <a href="${url}">
                                  <img class="img-fluid" alt src="${avatar}"> ${data.channel.username}
                              </a>`
                        document.getElementById('sidebarsubs').appendChild(elementSide);
                    })

                //console.log('radi');
            }
        });

    }
    else if(element.classList.contains('btn-outline-secondary')){

        element.classList.remove('btn-outline-secondary');
        element.textContent = "Subscribe";
        element.classList.add('btn-danger');
        //delete
        $.ajax({
            url:'/deleteSub',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        if(data.totalSubs === 1){
                            $("#subs-number").html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            $("#subs-number").html(`${data.totalSubs} subscribers`);

                        }
                        var itemi = $('input[type="hidden"].sidebar-item[value="' + subscribedId + '"]');
                        var listItem = itemi.closest('li');
                        listItem.remove();
                    })
            }
        });

    }

})

$('.subscribe-button-mini').click(function (){
    var element = $(this);
    if(element.hasClass('btn-outline-danger')){

        var subscribedId = $(this).closest('.popular-users').find('.subscribed-id').val();
        $.ajax({
            url:'/insertSub',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data)
                        if(data.totalSubs === 1){
                            element.closest('.popular-users').find('.total-subs').html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            //console.log(element.closest('.popular-users').find('.channels-view'))
                            element.closest('.popular-users').find('.total-subs').html(`${data.totalSubs} subscribers`);
                        }
                        //$('#sidebarsubs').html('aaaa');
                        //console.log(data.channel.avatar)

                        var url = xxxRoute.replace(':xxx', data.channel.id);
                        var avatar = xxxAvatar.replace(':xxx1',data.channel.avatar);
                        var elementSide = document.createElement('li');
                        elementSide.classList.add('channel-sidebar-list-item');
                        elementSide.innerHTML = `
                           <input type="hidden" name="sidebar-item" class="sidebar-item" value="${data.channel.id}"/>

                            <a href="${url}">
                              <img class="img-fluid" alt src="${avatar}"> ${data.channel.username}
                          </a>`
                        document.getElementById('sidebarsubs').appendChild(elementSide);
                    })
                element.removeClass('btn-outline-danger');
                element.text("Subscribed");
                element.addClass('btn-outline-secondary');
                //console.log('radi');
            }
        });
    }
    else if(element.hasClass('btn-outline-secondary')){

        var subscribedId = $(this).closest('.popular-users').find('.subscribed-id').val();
        var element = $(this);
        $.ajax({
            url:'/deleteSub',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data.length)
                        if(data.totalSubs === 1){
                            element.closest('.popular-users').find('.total-subs').html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            element.closest('.popular-users').find('.total-subs').html(`${data.totalSubs} subscribers`);

                        }
                    })
                element.removeClass('btn-outline-secondary');
                element.text("Subscribe");
                element.addClass('btn-outline-danger');
                // var itemi = $('.sidebar-item');
                var itemi = $('input[type="hidden"].sidebar-item[value="' + subscribedId + '"]');
                var listItem = itemi.closest('li');
                listItem.remove();
                console.log(itemi)

            }
        });
    }
    // document.getElementsByClassName('subscribe-button-mini')[0].classList.remove('btn-outline-danger');
    // document.getElementsByClassName('subscribe-button-mini')[0].classList.add('btn-outline-secondary');
})



$(document).on('click','.likeMoj',function (event){
    event.preventDefault();
    var idTrenutni = $("#userId").val();
    //console.log(idTrenutni);
    if (idTrenutni === "null"){
        window.location.href="/login";
        return;

    }
    var dislikeMoj1 = $(this).next('.dislikeMoj');
    if (dislikeMoj1.hasClass('disliked')) {
        dislikeMoj1.removeClass('disliked');
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        $.ajax({
            url:'/deleteReaction',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    if($(this).hasClass('liked')){
        $(this).removeClass('liked')
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();

        $.ajax({
            url:'/deleteReaction',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    else{
        $(this).addClass('liked');
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        $.ajax({
            url:'/commentReaction',
            method:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    // $(this).toggleClass('liked')
    //ajax za lajk...
})

$(document).on('click','.dislikeMoj',function (event){
    event.preventDefault();
    var idTrenutni = $("#userId").val();
    //console.log(idTrenutni);
    if (idTrenutni === "null"){
        window.location.href="/login";
        return;

    }
    var likeMoj1 = $(this).prev('.likeMoj');
    if (likeMoj1.hasClass('liked')) {
        likeMoj1.removeClass('liked');
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        $.ajax({
            url:'/deleteReaction',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    if($(this).hasClass('disliked')){
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();

        $(this).removeClass('disliked')
        $.ajax({
            url:'/deleteReaction',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    else{
        $(this).addClass('disliked')
        var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        $.ajax({
            url:'/commentReaction',
            method:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                commentID: commentID1,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/comments/' + commentID1 + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#likes-count-" + commentID1).html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#dislikes-count-" + commentID1).html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })

            }
        });
    }
    //$(this).toggleClass('liked')
    //ajax dislike...
})

//VIDEO LIKE DISLIKE POCETAK
$(document).on('click','.likeMojVideo',function (event){
    var idTrenutni = $("#userId").val();

    event.preventDefault();
    //console.log(idTrenutni);
    if (idTrenutni === "null"){
        window.location.href="/login";
        return;

    }
    var dislikeMoj1 = $(this).next('.dislikeMojVideo');
    if (dislikeMoj1.hasClass('disliked')) {
        dislikeMoj1.removeClass('disliked');
        //var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        var videoId = $('#videoid').val();
        $.ajax({
            url:'/videoReactionDelete',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    if($(this).hasClass('liked')){
        $(this).removeClass('liked')
        //var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        var videoId = $('#videoid').val();
        $.ajax({
            url:'/videoReactionDelete',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    else{
        $(this).addClass('liked');
        var videoId = $('#videoid').val();
        //var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        $.ajax({
            url:'/videoReaction',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    // $(this).toggleClass('liked')
    //ajax za lajk...
})

$(document).on('click','.dislikeMojVideo',function (event){
    event.preventDefault();
    var idTrenutni = $('#userId').val();
    if (idTrenutni === "null"){
        window.location.href="/login";
        return;
    }
    var likeMoj1 = $(this).prev('.likeMojVideo');
    if (likeMoj1.hasClass('liked')) {
        likeMoj1.removeClass('liked');
        // var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        var videoId = $('#videoid').val();
        $.ajax({
            url:'/videoReactionDelete',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 1,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    if($(this).hasClass('disliked')){
        //var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        var videoId = $('#videoid').val();
        $(this).removeClass('disliked')
        $.ajax({
            url:'/videoReactionDelete',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    else{
        $(this).addClass('disliked')
        //var commentID1 = $(this).closest('.reviews-members').find('.commentid').val();
        var videoId = $('#videoid').val();

        $.ajax({
            url:'/videoReaction',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                videoId: videoId,
                reactionId: 2,
                userId:2
            },
            success:function (){
                fetch('/videos/' + videoId + '/reactions')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        $("#video-total-likes").html(`<i class="fas fa-thumbs-up"></i> ${data.likesCount}`);
                        $("#video-total-dislikes").html(`<i class="fas fa-thumbs-down"></i> ${data.dislikesCount}`);
                    })
            }
        });
    }
    //$(this).toggleClass('liked')
    //ajax dislike...
})
//VIDEO LIKE DISLIKE KRAJ




//subscribe kanal stranica pocetak
$('.subscribe-button-mini-kanal').click(function (){
    //console.log('radi');
    //console.log(document.getElementById('subdugme').classList);
    //console.log(document.getElementsByClassName('subscribe-button')[0].classList);
    // document.getElementById('subdugme').classList.remove('btn-danger');
    // document.getElementById('subdugme').classList.add('btn-outline-secondary');

    //var element = document.getElementsByClassName('subscribe-button-mini')[0];
    var element = $(this);
    //console.log(element.closest('.popular-users').find('.channels-view'))
    if(element.hasClass('btn-outline-danger')){

        var subscribedId = $(this).closest('.single-channel-page').find('.subscribed-id').val();
        $.ajax({
            url:'/insertSub',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data)
                        if(data.totalSubs === 1){
                            element.closest('.single-channel-page').find('.total-subs').html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            //console.log(element.closest('.popular-users').find('.channels-view'))
                            element.closest('.single-channel-page').find('.total-subs').html(`${data.totalSubs} subscribers`);
                        }
                        element.removeClass('btn-outline-danger');
                        element.text("Subscribed");
                        element.addClass('btn-outline-secondary');
                        var url = xxxRoute.replace(':xxx', data.channel.id);
                        var avatar = xxxAvatar.replace(':xxx1',data.channel.avatar);
                        var elementSide = document.createElement('li');
                        elementSide.classList.add('channel-sidebar-list-item');
                        elementSide.innerHTML = `
                           <input type="hidden" name="sidebar-item" class="sidebar-item" value="${data.channel.id}"/>

                            <a href="${url}">
                              <img class="img-fluid" alt src="${avatar}"> ${data.channel.username}
                          </a>`
                        document.getElementById('sidebarsubs').appendChild(elementSide);
                    })

                //console.log('radi');
            }
        });
    }
    else if(element.hasClass('btn-outline-secondary')){

        var subscribedId = $(this).closest('.single-channel-page').find('.subscribed-id').val();
        var element = $(this);
        $.ajax({
            url:'/deleteSub',
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                subbedChannel: subscribedId
            },
            success:function (){
                fetch('/users/' + subscribedId + "/subscribers")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        //console.log(data.length)
                        if(data.totalSubs === 1){
                            element.closest('.single-channel-page').find('.total-subs').html(`${data.totalSubs} subscriber`);
                        }
                        else{
                            element.closest('.single-channel-page').find('.total-subs').html(`${data.totalSubs} subscribers`);
                        }
                    })
                element.removeClass('btn-outline-secondary');
                element.text("Subscribe");
                element.addClass('btn-outline-danger');
                var itemi = $('input[type="hidden"].sidebar-item[value="' + subscribedId + '"]');
                var listItem = itemi.closest('li');
                listItem.remove();
            }
        });
    }
})
//subscribe kanal stranica kraj
$('#cancel-comment').click(function (){
    $('#main-comment-text').val('');
})

//delete video sa dachboarda
$(document).on('click','#dl-v',function (element){
    element.preventDefault();

    const deleteForm = $("#delete-form");
    deleteForm.submit();
})


function updateCommentCount() {
    var videoid = $('#videoid').val();
    $.ajax({
        url: '/commentsCount',
        method: 'GET',
        data:{
            videoId :videoid
        },
        success: function(response) {
            console.log(response);
            $('#totalComments').text(response + ' Comments');
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function deleteComment(element,userId){
    if(userId.val() !== null && userId.val() === element.get_user.id){
        // console.log(userId.val());
    }
    let text = ``;
    if(userId.val() !== null && userId.val() == element.get_user.id){
        text += ` <span dir="rtl" class="pl-2 mt-3  ml-1 align-bottom">
                                 <a href="" id="deleteComment-${element.id}" class="deleteComment" ><i  class=" fas fa-delete fa-xs "></i>
                                      <span class=""> Delete </span>
                                 </a>
                           </span>`
    }
    return text;
}
$(document).on('click','.deleteComment',function (el){
    el.preventDefault();
    var x =  $(this).closest('.reviews-members').find('.commentid').val();
    //console.log(x);

    $.ajax({
        url:"/deleteComment",
        type:"DELETE",
        data:{
            commentId : x
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (){
            //console.log('radi')


            fetch('/comments/'+ $('#videoid').val())
                .then(response => response.json())
                .then(json => {
                    updateCommentCount();

                    writeComments(json);
                });
        }
    });
})
