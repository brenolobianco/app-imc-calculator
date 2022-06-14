let ValorRefrigerante = parseFloat(prompt("Digite o valor do refrigerante"));
let quantidadeRefrigerante = parseInt(prompt("Quantas Unidades ?"));
let TotalRefrigerante = quantidadeRefrigerante * ValorRefrigerante;

let ValorMacarrao = parseFloat(prompt("Digite o valor do Macarrao"));
let QuantidadeMacarrao = parseInt(prompt("Quantas Unidades ?"));
let TotalMacarrao = QuantidadeMacarrao * ValorMacarrao;

let ValorErvilha = parseFloat(prompt("Digite o valor do Ervilha"));
let QuantidadeErvilha = parseInt(prompt("Quantas Unidades ?"));
let TotalErvilha = QuantidadeErvilha * ValorErvilha

let ValorArroz = parseFloat(prompt("Digite o valor do Arroz"));
let QuantidadeArroz = parseInt(prompt("Quantas Unidades ?"));
let TotalArroz = QuantidadeArroz * ValorArroz

let ValorFeijao = parseFloat(prompt("Digite o valor do Feijao"));
let QuantidadeFeijao = parseInt(prompt("Quantas Unidades ?"));
let TotalFeijao = QuantidadeFeijao * ValorFeijao

let ValorVinho = parseFloat(prompt("Digite o valor do Vinho"));
let QuantidadeVinho = parseInt(prompt("Quantas Unidades ?"));
let TotalVinho = QuantidadeVinho * ValorVinho

let ValorTotalCompra = TotalRefrigerante + TotalMacarrao + TotalErvilha + TotalArroz + TotalFeijao + TotalVinho;
let ValorMetade = ValorTotalCompra / 2;

console.log("O Valor da Compra é R$" + ValorTotalCompra);
alert(`Valor total a ser pago R$: ${ValorTotalCompra}`);


if (ValorTotalCompra % 2 == 0) {
    let ValorVoce = ValorMetade - TotalVinho;
    let ValorAmigo = ValorMetade + TotalVinho;

    alert(" O valor da compra é um numero par, logo devo pagar R$" + ValorVoce + " e meu amigo R$" + ValorAmigo)

} else {
    let ValorVoce = ValorMetade;
    let ValorAmigo = ValorMetade;

    alert("O valor da compra é  um numero ímpar, logo devo pagar R$" + ValorVoce + " e meu amigo R$" + ValorAmigo)

}