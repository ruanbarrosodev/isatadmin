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
