$(document).ready(function (){

     const fetch_data = (page, search, search1, sort_type, sort_by) => {
         if(search === undefined){
             search = "";
                  }
         if(sort_type === undefined){
             sort_type = "";
         }
         if(sort_by === undefined){
             sort_by = "";
         }
         if(search1 === undefined){
             search1 = "";
         }
         $.ajax({
             url: '?page=' + page+"&search="+search+"&search1="+search1+"&sorttype="+sort_type+"&sortby="+sort_by,
             type: "get",
             datatype: "html",
             success:function (data){
                 // $("#videi").empty().html(data);
                 $("#videi").html();
                 $("#videi").html(data);
             }
         })
     }

     $(document).on('click', '#search-video-button', function(e){
         e.preventDefault();

         var seach_term = $('#search-video-input').val();

         var column_name = $('#hidden_column_name').val();
         var sort_type = $('#hidden_sort_type').val();
         var page = $('#hidden_page').val();
         var seach_term1 = $('#search-video-input1').val();
         if(seach_term.length > 0){
             var currentPage = window.location.pathname;
             if (currentPage !== '/') {
                 window.location.href = '/?page=' + page + "&search=" + seach_term + "&search1=&sorttype=" + sort_type + "&sortby=" + column_name;;
             }
             fetch_data(page,seach_term,seach_term1, sort_type,column_name);
         }
     });

    $(document).on('keypress', '#search-video-input', function(e){
        if (e.which === 13)
        {
            e.preventDefault();
            var seach_term = $('#search-video-input').val();

            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = $('#hidden_page').val();
            var seach_term1 = $('#search-video-input1').val();
            if(seach_term.length > 0){
                var currentPage = window.location.pathname;
                if (currentPage !== '/') {
                    window.location.href = '/?page=' + page + "&search=" + seach_term + "&search1=&sorttype=" + sort_type + "&sortby=" + column_name;;
                }
                fetch_data(page,seach_term,seach_term1, sort_type,column_name);
            }
        }
    });

     $(document).on('click', '.sorting', function(e){
         e.preventDefault();
         var column_name = $(this).data('column_name');
         var order_type = $(this).data('sorting_type');
         var reverse_order = '';

         if(order_type == "asc")
         {
             $(this).data("sorting_type", "desc");
             reverse_order = "desc";
         }

         if(order_type == "desc")
         {
             $(this).data("sorting_type", "asc");
             reverse_order = "asc";
         }

         $('#hidden_column_name').val(column_name);
         $('#hidden_sort_type').val(reverse_order);
         var page = $('#hidden_page').val();
         var seach_term = $('#search-video-input').val();
         var seach_term1 = $('#search-video-input1').val();
         fetch_data(page, seach_term, seach_term1, reverse_order, column_name);
     });

     $(document).on('keyup', '#search-video-input1', function(e){
         e.preventDefault();
         var column_name = $('#hidden_column_name').val();
         var sort_type = $('#hidden_sort_type').val();
         var seach_term1 = $('#search-video-input1').val();
         var seach_term = $('#search-video-input').val();
         var page = $('#hidden_page').val();
         fetch_data(page, seach_term, seach_term1, sort_type, column_name);
     });

         $(document).on('click', '.pagination a', function(event){
             event.preventDefault();
             var page = $(this).attr('href').split('page=')[1];
             $('#hidden_page').val(page);
             var sort_type = $('#hidden_sort_type').val();
             var column_name = $('#hidden_column_name').val();
             var seach_term = $('#search-video-input').val();
             var seach_term1 = $('#search-video-input1').val();
             fetch_data(page, seach_term, seach_term1, sort_type, column_name);
         });
 })

