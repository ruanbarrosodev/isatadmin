  const radios = document.querySelectorAll('input[name="tipoDocumento"]');
  const docInput = document.getElementById('documento');

  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === 'cpf') {
        docInput.name = 'cpf';
        docInput.placeholder = 'Digite o CPF';
      } else {
        docInput.name = 'rg';
        docInput.placeholder = 'Digite o RG';
      }
    });
  });
