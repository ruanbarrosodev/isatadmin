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

$(document).ready(function() {
    // Contadores para gerar names únicos (ex: beneficio_tipo[0], beneficio_tipo[1])
    let countBeneficios = 0;
    let countDespesas = 0;
    let countAfiliacoes = 0;

    // Botão "Adicionar" (abre o form)
    $(".add-btn").click(function() {
        const target = $(this).data("target");
        $("#" + target).toggleClass("active");
    });
    
    // Adicionar Benefício
    $("#add-beneficio").click(function() {
        const tipo = $("#beneficio-tipo").val();
        const valor = $("#beneficio-valor").val();
        
        if (!tipo || !valor) {
            alert("Preencha todos os campos!");
            return;
        }
        
        // Adiciona inputs hidden ao form principal
        const hiddenInputs = `
            <input type="hidden" name="beneficio_tipo[${countBeneficios}]" value="${tipo}">
            <input type="hidden" name="beneficio_valor[${countBeneficios}]" value="${valor}">
        `;
        
        // Adiciona o item visível na lista
        const itemHtml = `
            <div class="item" data-index="${countBeneficios}">
                <div class="item-info">
                    <strong>${tipo}</strong>: R$ ${parseFloat(valor).toFixed(2)}
                </div>
                <button type="button" class="delete-btn">Excluir</button>
                ${hiddenInputs}
            </div>
        `;
        
        $("#beneficios-list").append(itemHtml);
        $("#beneficio-tipo, #beneficio-valor").val("");
        $("#beneficios-form").removeClass("active");
        countBeneficios++;
    });
    
    // Adicionar Despesa (lógica similar)
    $("#add-despesa").click(function() {
        const descricao = $("#despesa-descricao").val();
        const valor = $("#despesa-valor").val();
        
        if (!descricao || !valor) {
            alert("Preencha todos os campos!");
            return;
        }
        
        const hiddenInputs = `
            <input type="hidden" name="despesa_descricao[${countDespesas}]" value="${descricao}">
            <input type="hidden" name="despesa_valor[${countDespesas}]" value="${valor}">
        `;
        
        const itemHtml = `
            <div class="item" data-index="${countDespesas}">
                <div class="item-info">
                    <strong>${descricao}</strong>: R$ ${parseFloat(valor).toFixed(2)}
                </div>
                <button type="button" class="delete-btn">Excluir</button>
                ${hiddenInputs}
            </div>
        `;
        
        $("#despesas-list").append(itemHtml);
        $("#despesa-descricao, #despesa-valor").val("");
        $("#despesas-form").removeClass("active");
        countDespesas++;
    });
    
    // Adicionar Afiliação
    $("#add-afiliacao").click(function() {
        const entidade = $("#afiliacao-entidade").val();
        const data = $("#afiliacao-data").val();
        
        if (!entidade || !data) {
            alert("Preencha todos os campos!");
            return;
        }
        
        const hiddenInputs = `
            <input type="hidden" name="afiliacao_entidade[${countAfiliacoes}]" value="${entidade}">
            <input type="hidden" name="afiliacao_data[${countAfiliacoes}]" value="${data}">
        `;
        
        const itemHtml = `
            <div class="item" data-index="${countAfiliacoes}">
                <div class="item-info">
                    <strong>${entidade}</strong> (desde ${data})
                </div>
                <button type="button" class="delete-btn">Excluir</button>
                ${hiddenInputs}
            </div>
        `;
        
        $("#afiliacao-list").append(itemHtml);
        $("#afiliacao-entidade, #afiliacao-data").val("");
        $("#afiliacao-form").removeClass("active");
        countAfiliacoes++;
    });
    
    // Excluir item (remove tanto o visual quanto os inputs hidden)
    $(document).on("click", ".delete-btn", function() {
        $(this).closest(".item").remove();
    });
});
