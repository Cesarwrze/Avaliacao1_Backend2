function cancelarVenda(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Cancelar compra',
        text: "Você tem certeza que deseja cancelar esta compra?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, cancelar',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    });
}
