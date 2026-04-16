document.addEventListener('DOMContentLoaded', function() {
    const radioEntrega = document.getElementById('entrega');
    const radioRetirada = document.getElementById('retirada');
    const areaEndereco = document.getElementById('area-endereco');
    const inputEndereco = document.getElementById('endereco');

    if(radioRetirada && radioEntrega) {
        radioRetirada.addEventListener('change', () => {
            areaEndereco.style.display = 'none';
            inputEndereco.removeAttribute('required');
        });

        radioEntrega.addEventListener('change', () => {
            areaEndereco.style.display = 'block';
            inputEndereco.setAttribute('required', '');
        });
    }
});