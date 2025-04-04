function avisoLogin(event) {
    event.preventDefault();

    Swal.fire({
        title: "Acesso negado",
        text: "Você precisa estar logado para executar esta ação",
        icon: "warning",
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: "Ok"
    });
}
