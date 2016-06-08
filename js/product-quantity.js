function subtractQty1() {
    if(document.getElementById("qty1").value - 1 < 1)
        return;
    else
        document.getElementById("qty1").value--;
        document.getElementById('total-price').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
        document.getElementById('subtotal').innerHTML = parseFloat(parseInt(document.getElementById('qty1').value) * parseFloat(document.getElementById('unit-price').innerText)).toFixed(2);
        document.getElementById('vat').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal')) * 14.5 / 100 ).toFixed(2);
        document.getElementById('final-price').innerHTML = parseFloat(parseFloat(document.getElementById('subtotal')) + parseFloat(document.getElementById('vat'))).toFixed(2);
}

