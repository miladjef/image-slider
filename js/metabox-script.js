jQuery(document).ready(function($){
    //Jquery code
    
    $("li.hmis-add-slide").click(function(){
        $("#hmis-lightbox-data").lightbox_me({
            centered: true,
            closeSelector: '.hmis-action-cancel',
            onLoad : function(){
                
                $("input.hmis-action-insert").val(hmis_data.insert);
                $("#hmis-current-slide").val(0);
                $("#hmis-lightbox-data img").attr('src', hmis_data.default_image_url);
                $("#hmis-select-caption").val('');
                $("#hmis-select-url").val('');
                
            }
        });
    });
    
    $(document).on('click', '#hmis-metabox li:not(.hmis-add-slide)', function(){
        
        var slideId         = $(this).data('slide');
        var inputElemets    = $(this).find('input');
        var imgUrl          = $(inputElemets).eq(0).val();
        var caption        = $(inputElemets).eq(1).val();
        var url             = $(inputElemets).eq(2).val();
        
        $("#hmis-lightbox-data").lightbox_me({
            centered: true,
            closeSelector: '.hmis-action-cancel',
            onLoad : function(){
                
                $("input.hmis-action-insert").val(hmis_data.edit);
                $("#hmis-current-slide").val(slideId);
                $("#hmis-lightbox-data img").attr('src', imgUrl);
                $("#hmis-select-caption").val(caption);
                $("#hmis-select-url").val(url);
                
            }
        });
        
    });
    
    $("#hmis-lightbox-data img").click(function(){
        var el = $(this);
        tb_show(hmis_data.tb_title, 'media-upload.php?type=image&TB_iframe=true');
        window.send_to_editor = function( html ){
            var imgUrl = $('img', html).attr('src');
            $(el).attr('src', imgUrl);
            $(el).removeClass('not-selected');
            tb_remove();
        }
        return false;
    });
    
    $("input.hmis-action-insert").click(function(){
        
        var currentSlide= $('#hmis-current-slide').val();
        var imgUrl      = $('#hmis-lightbox-data img').attr('src');
        var caption     = $('#hmis-select-caption').val();
        var url         = $('#hmis-select-url').val();
        
        if( hmis_data.default_image_url == imgUrl ) {
            alert(hmis_data.no_image_select);
            return false;
        }else{
            if( currentSlide == 0 ){
                var lastId = $("li.hmis-add-slide").prev().data('slide');
                lastId++;
                var newHtml = '<li class="slide" title="' + caption + '" data-slide="'+lastId+'" data-content="' + hmis_data.edit + '"><img src="' + imgUrl + '"><input type="hidden" name="hmis_slide_images[]" value="'+imgUrl+'"><input type="hidden" name="hmis_slide_captions[]" value="'+caption+'"><input type="hidden" name="hmis_slide_urls[]" value="'+url+'"></li>';
                $(newHtml).insertBefore('li.hmis-add-slide');
            }else{
                var slideForEdit = $("li[data-slide='" + currentSlide + "'] *");
                $("li[data-slide='" + currentSlide + "']").attr('title', caption);
                $(slideForEdit).eq(0).attr('src', imgUrl);
                $(slideForEdit).eq(1).val(imgUrl);
                $(slideForEdit).eq(2).val(caption);
                $(slideForEdit).eq(3).val(url);
            }
        }
        $("#hmis-lightbox-data").trigger('close');
        
        return false;
    });
    
});