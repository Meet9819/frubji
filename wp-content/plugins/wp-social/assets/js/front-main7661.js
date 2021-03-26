jQuery(document).ready(function($){
    var share_container;
    $(window).on('resize.wslu', function(){
        
        share_container = $('.xs_social_share_widget.wslu-share-horizontal.wslu-main_content'),
        parent = share_container.parent(),
        shareCount = share_container.find('.wslu-share-count'),
        parentWidth = parent.width();
        shareContainerWidth = share_container.find('ul').outerWidth(true);

        shareCount.length ? shareContainerWidth += shareCount.outerWidth(true) : '';



        if(shareContainerWidth > parentWidth){
            var shareCountWidth = shareCount.length ? shareCount.outerWidth(true) : 0;
            temLength =  shareCountWidth ? shareCountWidth : 0;
                var listItem = share_container.find('ul li'),
                lastELementWidth;
            for(let i = 0; i <= listItem.length; i++ ){
                temLength += $(listItem).eq(i).outerWidth(true);
             
                if(temLength > parentWidth){
                   
                    temLength -= $(listItem).eq(i).outerWidth(true);
                    lastELementWidth = $(listItem).eq(i-2).outerWidth(true);
                    break;
                }
            }



            // $.each(share_container.find('ul li'), function(){
            //     temLength += $(this).outerWidth(true);
            //     console.log(temLength, shareContainerWidth)
            //     if(temLength >= shareContainerWidth){
                   
            //         temLength -= $(this).outerWidth(true);
            //         return false;
            //     }
            // })
            console.log(temLength);

            var listItemWidth = share_container.find('ul').css('flex-wrap', 'wrap').find('li').outerWidth(true),
                shareBTN = 76;

            //     back = 2;

            //     if(share_container.find('ul > li').eq(wrapperItemsPos - 2 ).outerWidth(true) > share_container.find('.wslu-share-more-btn').outerWidth){
            //         back = 3;
            //     }
            // share_container.find('ul').css('flex-wrap', 'wrap').find('li').each(function(){
            //         var this_width = $(this).outerWidth(true);
            //         if (this_width > listItemWidth) listItemWidth = this_width;
            // });
        
     
            
            var wrapperItemsPos = Math.floor((temLength - shareCountWidth) / lastELementWidth);
            var back = shareBTN > lastELementWidth ? Math.ceil(shareBTN / lastELementWidth) : 1;


            share_container.find('ul li').slice( wrapperItemsPos -  back ).wrapAll( "<div class='wslu-share-more'><ul></ul></div>" );
            
        }
    }).trigger('resize.wslu');

    share_container.find('.wslu-share-more').prepend('<span class="wslu-share-more-btn-close met-social met-social-cross"></span><h3 class="wslu-share-more-btn-title">Share this with:</h3>').before('<li class="wslu-share-more-btn"><a href="#"><div class="wslu-both-counter-text"><span class="wslu-share-more-btn--icon met-social met-social-share-1"></span> Share</div></a></li>');

    $('.xs_social_share_widget').on('click', '.wslu-share-more-btn', function(){
        $(this).addClass('active').next().addClass('active');
    });
    $('.xs_social_share_widget').on('click', '.wslu-share-more-btn-close', function(){
        $(this).parent().removeClass('active').prev().removeClass('active');
    });
});