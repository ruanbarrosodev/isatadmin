$(document).ready(function(){
    $('input[name="cpf"]').on('input', function() {
        let value = $(this).val();

        value = value.replace(/\D/g, '');

        if(value.length > 3 && value.length <= 6){
            value = value.replace(/(\d{3})(\d+)/, '$1.$2');
        } else if(value.length > 6 && value.length <= 9){
            value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
        } else if(value.length > 9){
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4');
        }

        if(value.length > 14){
            value = value.substring(0, 14);
        }

        $(this).val(value);
    });

      $.ajax({
          url: '/actions/GenericAction.php?action=listExpense',
          method: 'GET',
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  const $select = $('#part1-select');
                  $select.empty();
                  $select.append('<option value="" disabled selected>Selecione uma despesa</option>');

                  $.each(response.data, function(index, item) {
                      $select.append($('<option>', {
                          value: item.idExpense,
                          text: item.expense
                      }));
                  });
              } else {
                  console.error('Erro: resposta sem sucesso');
              }
          },
          error: function(xhr, status, error) {
              console.error('Erro ao carregar despesas:', error);
          }
      });
      $(document).ready(function() {
      $.ajax({
          url: '/actions/GenericAction.php?action=listBenefit',
          method: 'GET',
          dataType: 'json',
          success: function(response) {
              if(response.success) {
                  const part2Select = $('#part2-select');
                  response.data.forEach(function(benefit) {
                      const option = $('<option></option>')
                          .val(benefit.idBenefit)  
                          .text(benefit.benefit); 
                      part2Select.append(option);
                  });
              } else {
                  console.error('Erro ao carregar benefícios:', response);
              }
          },
          error: function(xhr, status, error) {
              console.error('Erro na requisição AJAX:', error);
          }
      });
  });




});

const steps = document.querySelectorAll('.form-step');
const nextBtns = document.querySelectorAll('.next');
const prevBtns = document.querySelectorAll('.prev');

let currentStep = 0;

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('active', i === index);
  });
}
nextBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
    }
  });
});
prevBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });
});
showStep(currentStep);
document.querySelectorAll('.close-modal').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.modal-overlay').forEach(function(modal) {
            modal.style.display = 'none';
            document.querySelector(".container").innerHTML = "Sem usuário selecionado! Atualize a página e insira o CPF";
        });
    });
}); 


// Parte 1
const part1Select = document.getElementById('part1-select');
const part1List = document.getElementById('part1-list');

document.getElementById('add-part1').addEventListener('click', () => {
  const selected = part1Select.value;
  const selectedText = part1Select.options[part1Select.selectedIndex].text;
  if (!selected) return;

  // Verifica se já foi adicionado
  const alreadyAdded = Array.from(part1List.children).some(item =>
    item.querySelector('input[name="idExpense[]"]').value === selected
  );
  if (alreadyAdded) {
    alert('Esta despesa já foi adicionada.');
    return;
  }

  const item = document.createElement('div');
  item.className = 'list-item';
  item.innerHTML = `
    <span>${selectedText}</span>
    <input name="howMuch[]" type="text" placeholder="Valor">
    <input name="idExpense[]" type="hidden" value="${selected}">
    <button type="button" class="remove-btn">&times;</button>
  `;
  item.querySelector('.remove-btn').addEventListener('click', () => item.remove());
  part1List.appendChild(item);
});

// Parte 2const part2Select = document.getElementById('part2-select');
const part2Select = document.getElementById('part2-select');
const part2List = document.getElementById('part2-list');
let benefitIndex = 0;

function reindexApproved() {
  const items = part2List.querySelectorAll('.list-item');
  items.forEach((item, index) => {
    const radios = item.querySelectorAll('input[type="radio"]');
    radios.forEach(radio => {
      radio.name = `approved[${index}]`;
    });
  });
  benefitIndex = items.length;
}

document.getElementById('add-part2').addEventListener('click', () => {
  const selected = part2Select.value;
  const selectedText = part2Select.options[part2Select.selectedIndex].text;
  if (!selected) return;

  // Checa se já tem essa despesa adicionada para evitar duplicata (opcional)
  const existing = Array.from(part2List.children).some(item =>
    item.querySelector('input[name="idBenefit[]"]').value === selected
  );
  if (existing) {
    alert('Este benefício já foi adicionado.');
    return;
  }

  const item = document.createElement('div');
  item.className = 'list-item';
  item.innerHTML = `
    <span>${selectedText}</span>
    <input name="idBenefit[]" value="${selected}" type="hidden">
    <input name="qtdBenefited[]" type="text" placeholder="Valor">
    <label>
      <input type="radio" name="approved[${benefitIndex}]" value="sim" checked> Aprovado
    </label>
    <label>
      <input type="radio" name="approved[${benefitIndex}]" value="nao"> Não
    </label>
    <button type="button" class="remove-btn">&times;</button>
  `;

  item.querySelector('.remove-btn').addEventListener('click', () => {
    item.remove();
    reindexApproved();
  });

  part2List.appendChild(item);
  benefitIndex++;
});
// Parte 3 - Modal
const modal = document.getElementById('modal');
const openModal = document.getElementById('open-modal');
const closeModal = document.getElementById('close-modal-2');
const addFamily = document.getElementById('add-family');
const familyList = document.getElementById('family-list');

openModal.addEventListener('click', () => modal.classList.add('active'));
closeModal.addEventListener('click', () => modal.classList.remove('active'));
modal.addEventListener('click', (e) => {
  if (e.target === modal) modal.classList.remove('active');
});
addFamily.addEventListener('click', () => {
  const type = document.getElementById('family-type').value;
  const name = document.getElementById('family-name').value;
  const tel = document.getElementById('family-tel').value;
  const rg = document.getElementById('family-rg').value;
  const cpf = document.getElementById('family-cpf').value;
  const dob = document.getElementById('family-dob').value;
  const degree = document.getElementById('family-degree').value;
  const job = document.getElementById('family-job').value;
  const edu = document.getElementById('family-edu').value;
  const income = document.getElementById('family-income').value;
  const item = document.createElement('div');
  item.className = 'list-item';
  item.innerHTML = `
    <span>${type} - ${name}</span>
    <input name="typeResident[]" type="hidden" value="${type}">
    <input name="nameResident[]" type="hidden" value="${name}">
    <input name="telResident[]" type="hidden" value="${tel}">
    <input name="rgResident[]" type="hidden" value="${rg}">
    <input name="cpfResident[]" type="hidden" value="${cpf}">
    <input name="bornDate[]" type="hidden" value="${dob}">
    <input name="degreeFamily[]" type="hidden" value="${degree}">
    <input name="professionResident[]" type="hidden" value="${job}">
    <input name="educationResident[]" type="hidden" value="${edu}">
    <input name="rentResident[]" type="hidden" value="${income}">
    <button type="button" class="remove-btn">&times;</button>
  `;
  item.querySelector('.remove-btn').addEventListener('click', () => item.remove());
  familyList.appendChild(item);


  modal.classList.remove('active');
});


