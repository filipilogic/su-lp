jQuery(document).ready(function ($) {

    // Mobile navigation

    $(".menu-toggle").click(function () {
        $("#primary-menu").fadeToggle();
        $(this).toggleClass('menu-open')
    });

    $( "#primary-menu li" ).click(function() {
        var windowsize = $(window).width();
        if (windowsize < 1200) {
            $("#primary-menu").fadeToggle();
            $(".menu-toggle").toggleClass('menu-open')
        }
    });
    
    // Sub Menu Trigger

    $( "#primary-menu li.menu-item-has-children > a" ).after('<span class="sub-menu-trigger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>');

    $( ".sub-menu-trigger" ).click(function() {
		$( this ).parent().toggleClass('sub-menu-open')
		$( this ).siblings(".sub-menu").slideToggle();
	});


    // AJAX Load More bttn
    $(document).on('click', '.ilLoadMore', function (e) {
        e.preventDefault() //prevent default action
        
        const category = $(this).data('category')
        let postCategory = 'all'

        if (category) {
          postCategory = category
        }

        if (!window.countPosts) {
          window.countPosts = 4
        }

        $.ajax({
          type: 'GET',
          url: '/wp-admin/admin-ajax.php',
          data: {
            countPosts: window.countPosts,
            postCategory,
            action: 'blog_load_more',
          },
        }).done(function (resp) {
          window.countPosts += 4
         
          $('.il_archive_more').html(resp)
        })
      })

        $(document).on('click', '.il_blog_sidebar-category-heading', function (e) {
          $('.wp-block-categories-list').toggle(300);
          $('.il_blog_sidebar-category-heading').toggleClass('active-list');
        })
      
});

document.addEventListener( 'wpcf7mailsent', function( event ) {
location = '/thank-you';
}, false );