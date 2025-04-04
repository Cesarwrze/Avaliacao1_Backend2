function deletarProduto(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Você tem certeza?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, deletar produto!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    });
}

function aumentarQuantidade(botao, estoqueMaximo) {
    const input = botao.parentElement.querySelector('input');
    let valor = parseInt(input.value);
    if (valor < estoqueMaximo) {
        input.value = valor + 1;
    }
}

function diminuirQuantidade(botao) {
    const input = botao.parentElement.querySelector('input');
    let valor = parseInt(input.value);
    if (valor > 1) {
        input.value = valor - 1;
    }
}
