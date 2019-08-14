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
                let qty = 0;
                if($('#height_width_div').is(':visible')) 
                {
                    qty = $('#quantity_rec').val();
                    
                }
                else 
                {
                    qty = $('#quantity_sq_cir').val();
                }
                // Creating array of start to end based on qty
               let upperLimit    = Math.ceil(qty/100)*100;
               let lowerLimit    = Math.floor(qty/100)*100;
               let indexes       = [];
               for(i=50;i<(upperLimit+500);i=i+100)
               {
                   if(i == 50)
                   {
                        indexes.push(i);
                   }
                   else
                   {
                        indexes.push(Math.floor(i/100)*100)
                   }
               }

               // Inserting the qty to appropriate index
               $(indexes).each((index,ele) => {
                    if(qty > ele && qty < indexes[index+1]) 
                    {
                        intqty = parseInt(qty);
                        indexes.splice(index+1,0,intqty);
                    }
               });
               var tr = '';
               let width                = 0;
               let height               = 0;
               let price                = 0;
               let minCharge            = 0;
               let firstRoundPrice      = 0;
               if($('#height_width_div').is(':visible')) 
               {
                    width     = parseInt($('#width_rec').val());
                    height    = parseInt($('#height_rec').val());
                    price     = parseFloat($('#price_rec').val()).toFixed(2);
                    minCharge = parseFloat($('#min_charge_rec').val()).toFixed(2);
               }
               else
               {
                   width     = parseInt($('#width_sq_cir').val());
                   height    = parseInt($('#width_sq_cir').val());
                   price     = parseFloat($('#price_sq_cir').val()).toFixed(2);
                   minCharge = parseFloat($('#min_charge_sq_cir').val()).toFixed(2);
               }

               $.each(indexes,function(key,value) {
                let widthWithBleed      = (eval(width) + 8);
                let heightWithBleed     = (eval(height) + 8);
                let stickerPerRow       = parseFloat(1250/widthWithBleed).toFixed(6);
                let stickerPerRowRound  = Math.floor(stickerPerRow); 
                let noOfRowsInMtr       = parseFloat(value/stickerPerRowRound).toFixed(2);
                let heightInMtr         = parseFloat((heightWithBleed * noOfRowsInMtr)/1000).toFixed(2);
                let priceInTotSqm       = parseFloat(heightInMtr * eval(price)).toFixed(2);
                let priceTotInCharge    = eval(priceInTotSqm) + eval(40.00);
                let roundTotInCharge    = Math.ceil(priceTotInCharge);
                if(key == 0) {
                    firstRoundPrice = roundTotInCharge;
                }
                let baseOn50Qty         = (eval(value)/eval(50.00)) * eval(firstRoundPrice);
                let savings             = (Math.abs(eval(roundTotInCharge)-eval(baseOn50Qty))/eval(baseOn50Qty) * 100);
                tr += '<tr class="rowCal">';
                tr += '<td>' + widthWithBleed +'</td>';
                tr += '<td>' + heightWithBleed +'</td>';
                tr += '<td>' + stickerPerRow + '</td>';
                tr += '<td>' + stickerPerRowRound + '</td>';
                tr += '<td>' + value +'</td>';
                tr += '<td>' + noOfRowsInMtr +'</td>';
                tr += '<td>' + heightInMtr + '</td>';
                tr += '<td>£' + priceInTotSqm +'</td>';
                tr += '<td>£' + parseFloat(priceTotInCharge).toFixed(2) +'</td>';
                tr += '<td>£' + parseFloat(roundTotInCharge).toFixed(2) +'</td>';
                if(key == 0) {
                    tr += '<td></td>';
                    tr += '<td></td>';
                }
                else {
                    tr += '<td>' + parseFloat(baseOn50Qty).toFixed(2) +'</td>'
                    tr += '<td>' + parseFloat(savings).toFixed(2) +'%</td>'
                }
                tr += '</tr>';
               });
               $('.cal-table tr.rowCal').remove();
                $('#calculations').append(tr);
                $('#savePrice').show();
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
        if($('#price_id').val() !== '')
        {
            let width   = $('#width').val();
            let height  = $('#height').val();
            if(width === height) 
            {
               $('#sticker_type').val('square_circle').trigger('change');
            }
            else
            {
                $('#sticker_type').val('ractangle').trigger('change');
            }
            calPrice.trigger('click');
        }
    });
    
});