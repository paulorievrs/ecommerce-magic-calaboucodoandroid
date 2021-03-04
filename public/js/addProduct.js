let precoTotal = 0;

function changePayment() {
    let select = document.getElementById('pagamento');
    let value = select.options[select.selectedIndex].value;
    if(value === 'Promissória') {
        document.getElementById('financiamento').style.display = 'block';
    } else {
        document.getElementById('financiamento').style.display = 'none';

    }

}

function Adicionar() {
    let select = document.getElementById('produtos');
    let value = select.options[select.selectedIndex].value;
    let name = select.options[select.selectedIndex].innerText;
    let preco = document.getElementById('preco-' + value).value;
    let quantidade = document.getElementById('quantidadeProduto').value;
    if(!quantidade) {
        return;
    }
    if(quantidade <= 0) {
        return;
    }

    preco = parseInt(preco) * parseInt(quantidade);
    let selectedProducts = document.getElementById('selectedProducts');
    selectedProducts.value = selectedProducts.value + 'qtd=' + quantidade + '&id=' + value + '//';
    $("#produto tbody").append(
        "<tr id='td-" + value + "'>"+
        "<td><span>" + name + "</span></td>"+
        "<td><span>" + preco + "</span></td>"+
        "<td><span>" + quantidade + "</span></td>"+
        "<td><i class='material-icons' onclick='Excluir(this)' id='excluir-" + value + "' style='color: red; cursor: pointer'>delete</i></td>"+
        "</tr>");
    precoTotal += parseFloat(preco);
    document.getElementById('totalValue').innerHTML = '<span>Valor total: ' + precoTotal + '</span></span><input type="hidden" name="totalvalueback" value=' + precoTotal + ' />';
}


function Excluir(obj) {

    let par = $(obj).parent().parent(); //tr
    let id = par[0].id.split('-')[1];
    let td = document.getElementById('td-' + id);
    let precoDosProdutos = (td.children[1].innerText);
    precoTotal -= parseFloat(precoDosProdutos);
    document.getElementById('totalValue').innerHTML = '<span>Valor total: ' + precoTotal + '</span><input type="hidden" name="totalvalueback" value=' + precoTotal + ' />';
    let selectedProducts = document.getElementById('selectedProducts');
    par.remove();

    selectedProducts.value = selectedProducts.value.replace(new RegExp(`qtd=[0-9]+&id=${id}//`, 'i'),'')
}
