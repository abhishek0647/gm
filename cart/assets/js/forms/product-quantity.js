function updateReviewOrder() {
    var plainText = "<b>Thank you for using GasMarket. We will deliver your order of ";
    var quantity = document.getElementById('qty1').value;
    var currentTime = new Date();
    var currentDate = currentTime.getDate();
    var currentMonth = currentTime.getMonth();
    var currentYear = currentTime.getFullYear();

    if( currentTime.getHours() > 12){
        currentTime = currentTime + 24 * 60 * 60 * 1000;
        var newDate = new Date(currentTime);
        currentDate = newDate.getDate();
        currentMonth = newDate.getMonth();
        currentYear = newDate.getFullYear();
    }

    var finalText = plainText.concat(quantity.toString(), " gas cylinder(s) by ", currentDate, "-", currentMonth, "-", currentYear, " .<br>Please click 'Place Order' to complete your order.</b><button type='submit' class='btn-u btn-block' name='btn-place-order' id='btn-place-order'>Place Order</button>" );

    document.getElementById('order-review').innerHTML = finalText;
}

function subtractQty1() {
    if(document.getElementById("qty1").value - 1 < 1)
        return;
    else
        document.getElementById("qty1").value--;
        document.getElementById('total-price').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
        document.getElementById('subtotal').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
        var vatpercent = parseFloat(document.getElementById('vat-percent').innerHTML)/100;
        document.getElementById('vat').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) * vatpercent ).toFixed(2);
        document.getElementById('final-price').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) + parseFloat(document.getElementById('vat').innerHTML)).toFixed(2);
        updateReviewOrder();
}

function addQty1() {
    document.getElementById("qty1").value++;
    document.getElementById('total-price').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
    document.getElementById('subtotal').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
    document.getElementById('vat').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) * 0.145 ).toFixed(2);
    document.getElementById('final-price').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal').innerHTML) + parseFloat(document.getElementById('vat').innerHTML)).toFixed(2);
    updateReviewOrder();
}

