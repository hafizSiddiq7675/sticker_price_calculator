$(document).ready(function()
{
    jQuery(function()
    {
        let stickerType = $('#sticker_type');
        let calPrice    = $('#cal_price');
        let pageFunctions = {
            validateQuantity: function()
            {
                if($('#height_width_div').is(':visible')) 
                {
                    if (!($('#quantity_rec').val().trim() != '' && (parseInt($('#quantity_rec').val(), 10) >= 50))) 
                    {
                        $('#quantity_rec').siblings('span.error').css('visibility', 'visible');
                        $('#quantity_rec').val(50);
                        return false;
                    }
                    else 
                    {
                        $('#quantity_rec').siblings('span.error').css('visibility', 'hidden');
                        return true;
                    }
                }
                else 
                {
                    if (!($('#quantity_sq_cir').val().trim() != '' && (parseInt($('#quantity_sq_cir').val(), 10) >= 50))) 
                    {
                        $('#quantity_sq_cir').siblings('span.error').css('visibility', 'visible');
                        $('#quantity_sq_cir').val(50);
                        return false;
                    }
                    else
                    {
                        $('#quantity_sq_cir').siblings('span.error').css('visibility', 'hidden');
                        return true;
                    }
                }
            },
            buildCalTable: function()
            {
                if($('#height_width_div').is(':visible')) 
                {
                    let qty = $('#quantity_rec').val();
                    
                }
                let tr = '';
                tr += '<tr>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '<td>test</td>';
                tr += '</tr>';
            },
        }

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
           let error = pageFunctions.validateQuantity();
           if(error) 
           {
                pageFunctions.buildCalTable();
           }
        });
    });
});