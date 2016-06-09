function updateReviewOrder() {
    var plainText = "<b>Thank you for using GasMarket. We will deliver your order of ";
    var quantity = document.getElementById('qty1').value;
    var currentTime = new Date();
    var currentDate = currentTime.getDate();
    var currentMonth = currentTime.getMonth() + 1;
    var currentYear = currentTime.getFullYear();

    if( currentTime.getHours() > 12){
        currentTime = currentTime + 24 * 60 * 60 * 1000;
        var newDate = new Date(currentTime);
        currentDate = newDate.getDate();
        currentMonth = newDate.getMonth() + 1;
        currentYear = newDate.getFullYear();
    }

    var finalText = plainText.concat(quantity.toString(), " gas cylinder(s) by ", currentDate, "-", currentMonth, "-", currentYear, " .<br>Please click 'Place Order' to complete your order.</b><button type='submit' class='btn-u btn-block' name='btn-place-order' id='btn-place-order'>Place Order</button>" );

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