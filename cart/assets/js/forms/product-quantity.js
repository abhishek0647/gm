function updateReviewOrder() {
    var plainText = "<b>Thank you for using GasMarket. We will deliver your order of ";
    var quantity = document.getElementById('qty1').value;    

    var currentTime = new Date();

    var currentOffset = currentTime.getTimezoneOffset();

    var ISTOffset = 330;   // IST offset UTC +5:30 

    var ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);

    if(ISTTime.getHours() > 12) {
        newTime = new Date(ISTTime.getTime() + 24*60*60*1000);
        deliveryDate = newTime.getDate();
    }
    else {
        deliveryDate = ISTTime.getDate();
    }

    deliveryMonth = ISTTime.getMonth() + 1;
    deliveryYear = ISTTime.getFullYear();

    var finalText = plainText.concat(quantity.toString(), " gas cylinder(s) by ", deliveryDate, "-", deliveryMonth, "-", deliveryYear, " .<br>Please click 'Place Order' to complete your order.</b><br><button type='submit' class='btn-u btn-block' name='btn-place-order' id='btn-place-order' style='margin-top: 30px; width:125px;' onclick='javascript: disablePlaceOrderBtn();'>Place Order</button>" );

    document.getElementById('order-review').innerHTML = finalText;
}

function updateTableContent(vatpercent) {
    document.getElementById('total-price').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerHTML)).toFixed(2);

    document.getElementById('total-price-input').value = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerHTML)).toFixed(2);

    document.getElementById('subtotal').innerHTML = parseFloat(document.getElementById('total-price').innerHTML).toFixed(2);

    document.getElementById('subtotal-input').value = parseFloat(document.getElementById('total-price').innerHTML).toFixed(2);
    
    document.getElementById('vat').innerHTML = parseFloat(parseFloat(document.getElementById('qty1').value) * 145 ).toFixed(2);

    document.getElementById('vat-input').value = parseFloat(parseFloat(document.getElementById('qty1').value) * 145 ).toFixed(2);

    document.getElementById('final-price').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) + parseFloat(document.getElementById('vat').innerHTML)).toFixed(2);

    document.getElementById('final-price-input').value = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) + parseFloat(document.getElementById('vat').innerHTML)).toFixed(2);

    updateReviewOrder();
}

function subtractQty1() {
    if(document.getElementById("qty1").value - 1 < 1)
        return;
    else
        var vatpercent = parseFloat(parseFloat(document.getElementById('vat').value) / parseInt(document.getElementById('qty1').value));

        document.getElementById("qty1").value--;
        document.getElementById("qty1-hidden").value--;
        updateTableContent(vatpercent);
}

function addQty1() {
    var vatpercent = parseFloat(parseFloat(document.getElementById('vat').value) / parseInt(document.getElementById('qty1').value));

    document.getElementById("qty1").value++;
    document.getElementById("qty1-hidden").value++;
    updateTableContent(vatpercent)
}