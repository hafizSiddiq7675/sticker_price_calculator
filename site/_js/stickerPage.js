$(document).ready(function()
{
    jQuery(function()
    {
        let stickerType = $('#sticker_type');
        let calPrice    = $('#cal_price'); 
        stickerType.on('change',function()
        {
            let id = $(this).val();
            if(id == 0) 
            {
                $('#height_width_div').hide();
                $('#width_div').hide();
            }
            else if(id === 'square_circle') 
            {
                $('#height_width_div').hide();
                $('#width_div').show();
            }
            else 
            {
                $('#width_div').hide();
                $('#height_width_div').show();
            }
        });
        calPrice.on('click',function()
        {
            alert("Build Table");
        });
    });
});