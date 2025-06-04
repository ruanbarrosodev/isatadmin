$(document).ready(function() {
  // Carregar lista de despesas
    function loadBenefits() {
        $.ajax({
            url: '/actions/GenericAction.php?action=listBenefit',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const list = $('#benefit-list');
                    list.empty();
                    response.data.forEach(function(item) {
                        list.append(`<li>${item.benefit} <button class="delete-benefit-btn" data-id="${item.idBenefit}">Excluir</button></li>`);
                    });
                }
            }
        });
    }

    function loadExpenses() {
        $.ajax({
            url: '/actions/GenericAction.php?action=listExpense',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const list = $('#expense-list');
                    list.empty();
                    response.data.forEach(function(item) {
                        list.append(`<li>${item.expense} <button class="delete-expense-btn" data-id="${item.idExpense}">Excluir</button></li>`);
                    });
                }
            }
        });
}


  // Chama as funções ao carregar a página
  loadExpenses();
  loadBenefits();

    $('#expense-form').on('submit', function(e) {
        e.preventDefault();

        const expense = $('input[name="expense"]').val();

        $.ajax({
            url: '/actions/GenericAction.php',
            method: 'POST',
            data: {
                form_type: 'addExpense',
                expense: expense
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadExpenses();
                    $('#expense-form')[0].reset();
                } else {
                    alert('Erro ao adicionar despesa: ' + response.message);
                }
            }
        });
    });
    $(document).on('click', '.delete-expense-btn', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '/actions/GenericAction.php',
            method: 'POST',
            data: {
                form_type: 'deleteExpense',
                idExpense: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadExpenses();
                } else {
                    alert('Erro ao excluir despesa: ' + response.message);
                }
            }
        });
    });
    $('#benefit-form').on('submit', function(e) {
        e.preventDefault();

        const benefit = $('input[name="benefit"]').val();
        const typeBenefit = $('select[name="typeBenefit"]').val();
        const qtdBenefit = $('input[name="qtdBenefit"]').val();
        const description = $('input[name="description"]').val();

        $.ajax({
            url: '/actions/GenericAction.php',
            method: 'POST',
            data: {
                form_type: 'addBenefit',
                benefit: benefit,
                typeBenefit: typeBenefit,
                qtdBenefit: qtdBenefit,
                description: description
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadBenefits();
                    $('#benefit-form')[0].reset();
                } else {
                    alert('Erro ao adicionar benefício: ' + response.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-benefit-btn', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '/actions/GenericAction.php',
            method: 'POST',
            data: {
                form_type: 'deleteBenefit',
                idBenefit: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadBenefits();
                } else {
                    alert('Erro ao excluir benefício: ' + response.message);
                }
            }
        });
    });





});
